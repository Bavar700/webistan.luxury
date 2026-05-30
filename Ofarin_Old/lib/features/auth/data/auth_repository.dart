import 'dart:convert';
import 'package:crypto/crypto.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:supabase_flutter/supabase_flutter.dart' hide AuthState;
import '../domain/auth_state.dart';

// Provider for AuthRepository
final authRepositoryProvider = Provider<AuthRepository>((ref) {
  return AuthRepository();
});

// StateNotifier to manage AuthState
final authStateProvider = StateNotifierProvider<AuthNotifier, AuthState>((ref) {
  final repo = ref.watch(authRepositoryProvider);
  return AuthNotifier(repo);
});

// StateNotifier to manage current AppMode
final appModeProvider = StateNotifierProvider<AppModeNotifier, AppModeState>((ref) {
  final authRepo = ref.watch(authRepositoryProvider);
  return AppModeNotifier(authRepo);
});

class AppModeState {
  final AppMode mode;
  final UserProfile? activeChild;

  const AppModeState({
    required this.mode,
    this.activeChild,
  });

  AppModeState copyWith({
    AppMode? mode,
    UserProfile? activeChild,
    bool clearActiveChild = false,
  }) {
    return AppModeState(
      mode: mode ?? this.mode,
      activeChild: clearActiveChild ? null : (activeChild ?? this.activeChild),
    );
  }
}

class AppModeNotifier extends StateNotifier<AppModeState> {
  final AuthRepository _authRepo;
  AppModeNotifier(this._authRepo) : super(const AppModeState(mode: AppMode.none));

  void setMode(AppMode mode) {
    state = state.copyWith(mode: mode);
  }

  void setActiveChild(UserProfile? child) {
    state = state.copyWith(activeChild: child, mode: AppMode.child);
  }

  Future<void> refreshActiveChild() async {
    if (state.activeChild == null) return;
    try {
      final updatedChild = await _authRepo.fetchProfile(state.activeChild!.id);
      state = state.copyWith(activeChild: updatedChild);
    } catch (_) {}
  }

  void exitMode() {
    state = const AppModeState(mode: AppMode.none);
  }
}

class AuthRepository {
  late final SupabaseClient? _supabase = _getSupabaseClient();

  static SupabaseClient? _getSupabaseClient() {
    try {
      return Supabase.instance.client;
    } catch (_) {
      return null;
    }
  }

  static const bool bypassLoginForDev = true;

  bool get isMock => bypassLoginForDev || _supabase == null;

  // Helper to hash PIN codes
  String hashPin(String pin) {
    final bytes = utf8.encode(pin);
    final digest = sha256.convert(bytes);
    return digest.toString();
  }

  // Check if Supabase client is initialized and active
  bool _isSupabaseActive() {
    try {
      Supabase.instance.client;
      return true;
    } catch (_) {
      return false;
    }
  }

  SupabaseClient? get _client {
    if (bypassLoginForDev) return null;
    if (_isSupabaseActive()) {
      return Supabase.instance.client;
    }
    return null;
  }

  // 1. Sign In
  Future<UserProfile> signIn(String email, String password) async {
    final client = _client;
    if (client == null) {
      // Mock Sign In
      await Future.delayed(const Duration(milliseconds: 800));
      if (email == 'test@test.com' && password == 'password') {
        return const UserProfile(
          id: 'mock-parent-id',
          role: 'parent',
          displayName: 'Мадина (Модар)',
          starsBalance: 120,
          fiatBalance: 50.00,
        );
      } else {
        throw Exception('Пароли нодуруст ё корбар ёфт нашуд (Incorrect email or password)');
      }
    }

    final response = await client.auth.signInWithPassword(
      email: email,
      password: password,
    );

    if (response.user == null) {
      throw Exception('Воридшавӣ ноком шуд (Sign in failed)');
    }

    return await fetchProfile(response.user!.id);
  }

  // 2. Sign Up
  Future<UserProfile> signUp(String email, String password, String displayName) async {
    final client = _client;
    if (client == null) {
      // Mock Sign Up
      await Future.delayed(const Duration(milliseconds: 800));
      return UserProfile(
        id: 'mock-parent-id-${DateTime.now().millisecondsSinceEpoch}',
        role: 'parent',
        displayName: displayName,
      );
    }

    final response = await client.auth.signUp(
      email: email,
      password: password,
      data: {
        'display_name': displayName,
        'role': 'parent', // By default, registration makes a Parent
      },
    );

    if (response.user == null) {
      throw Exception('Сабти ном ноком шуд (Registration failed)');
    }

    // Give database trigger some time to populate the profile
    await Future.delayed(const Duration(milliseconds: 500));
    return await fetchProfile(response.user!.id);
  }

  // 3. Fetch User Profile
  Future<UserProfile> fetchProfile(String userId) async {
    final client = _client;
    if (client == null) {
      if (userId == 'mock-parent-id') {
        return const UserProfile(
          id: 'mock-parent-id',
          role: 'parent',
          displayName: 'Мадина (Модар)',
        );
      }
      final children = await _getMockChildren();
      final childIndex = children.indexWhere((c) => c.id == userId);
      if (childIndex != -1) {
        return children[childIndex];
      }
      return const UserProfile(
        id: 'mock-parent-id',
        role: 'parent',
        displayName: 'Мадина (Модар)',
      );
    }

    final data = await client
        .from('profiles')
        .select()
        .eq('id', userId)
        .single();

    return UserProfile.fromJson(data);
  }

  // Fallback mock children profiles
  static final List<UserProfile> _defaultChildren = [
    const UserProfile(
      id: 'mock-child-1',
      role: 'child',
      parentId: 'mock-parent-id',
      displayName: 'Алиҷон',
      avatarUrl: '🦊',
      starsBalance: 12,
      fiatBalance: 15.50,
      streakCount: 5,
    ),
    const UserProfile(
      id: 'mock-child-2',
      role: 'child',
      parentId: 'mock-parent-id',
      displayName: 'Ситода',
      avatarUrl: '🦄',
      starsBalance: 24,
      fiatBalance: 30.00,
      streakCount: 8,
    ),
  ];

  static List<UserProfile>? _customChildren;

  static Future<List<UserProfile>> _getMockChildren() async {
    if (_customChildren != null) return _customChildren!;
    try {
      final prefs = await SharedPreferences.getInstance();
      final jsonStr = prefs.getString('mock_children_profiles');
      if (jsonStr != null) {
        final List decoded = json.decode(jsonStr);
        _customChildren = decoded.map((item) => UserProfile.fromJson(item)).toList();
        return _customChildren!;
      }
    } catch (_) {}
    _customChildren = List.from(_defaultChildren);
    return _customChildren!;
  }

  static Future<void> _saveMockChildren(List<UserProfile> children) async {
    _customChildren = children;
    try {
      final prefs = await SharedPreferences.getInstance();
      final jsonStr = json.encode(children.map((c) => c.toJson()).toList());
      await prefs.setString('mock_children_profiles', jsonStr);
    } catch (_) {}
  }

  // 4. Fetch Child Profiles linked to parent
  Future<List<UserProfile>> fetchChildren(String parentId) async {
    final client = _client;
    if (client == null) {
      final children = await _getMockChildren();
      return children.where((c) => c.parentId == parentId).toList();
    }

    final data = await client
        .from('profiles')
        .select()
        .eq('parent_id', parentId)
        .eq('role', 'child');

    return (data as List).map((json) => UserProfile.fromJson(json)).toList();
  }

  // 5. Create a Child Profile
  Future<UserProfile> createChildProfile(String parentId, String displayName, {String? avatarUrl}) async {
    final client = _client;
    final childId = 'child-${DateTime.now().millisecondsSinceEpoch}';
    
    if (client == null) {
      final newChild = UserProfile(
        id: childId,
        role: 'child',
        parentId: parentId,
        displayName: displayName,
        avatarUrl: avatarUrl ?? '🦊',
      );
      final children = await _getMockChildren();
      children.add(newChild);
      await _saveMockChildren(children);
      return newChild;
    }

    final newChildData = {
      'id': '00000000-0000-0000-0000-${DateTime.now().millisecondsSinceEpoch.toString().padLeft(12, '0')}',
      'role': 'child',
      'parent_id': parentId,
      'display_name': displayName,
      'avatar_url': avatarUrl,
      'stars_balance': 0,
      'fiat_balance': 0.00,
      'streak_count': 0,
    };

    final response = await client
        .from('profiles')
        .insert(newChildData)
        .select()
        .single();

    return UserProfile.fromJson(response);
  }

  // 6. PIN Code Verification (Parent mode protect)
  Future<bool> verifyParentPin(String parentId, String pin) async {
    final client = _client;
    final hashed = hashPin(pin);

    if (client == null) {
      final prefs = await SharedPreferences.getInstance();
      final localPin = prefs.getString('parent_pin_hash_$parentId');
      if (localPin == null) {
        // First-time setup default pin: 1234
        if (pin == '1234') return true;
        return false;
      }
      return localPin == hashed;
    }

    final data = await client
        .from('profiles')
        .select('pin_hash')
        .eq('id', parentId)
        .single();

    final dbPinHash = data['pin_hash'] as String?;
    if (dbPinHash == null) {
      // Pin is not set yet
      return false;
    }
    return dbPinHash == hashed;
  }

  // 7. Save / Set Parent PIN Code
  Future<void> saveParentPin(String parentId, String pin) async {
    final client = _client;
    final hashed = hashPin(pin);

    final prefs = await SharedPreferences.getInstance();
    await prefs.setString('parent_pin_hash_$parentId', hashed);

    if (client != null) {
      await client
          .from('profiles')
          .update({'pin_hash': hashed})
          .eq('id', parentId);
    }
  }

  // 8. Sign Out
  Future<void> signOut() async {
    final client = _client;
    if (client != null) {
      await client.auth.signOut();
    }
  }

  // 9. Adjust Child Balance (Stars / Fiat)
  Future<void> updateChildBalance(String childId, double amount, String currencyType) async {
    if (isMock) {
      final children = await _getMockChildren();
      final index = children.indexWhere((c) => c.id == childId);
      if (index != -1) {
        final child = children[index];
        if (currencyType == 'stars') {
          final newBalance = (child.starsBalance + amount.toInt()).clamp(0, 999999);
          children[index] = child.copyWith(starsBalance: newBalance);
        } else {
          final newBalance = (child.fiatBalance + amount).clamp(0.00, 999999.00);
          children[index] = child.copyWith(fiatBalance: newBalance);
        }
        await _saveMockChildren(children);
      }
    } else {
      final client = _client;
      if (client != null) {
        final column = currencyType == 'stars' ? 'stars_balance' : 'fiat_balance';
        // Read current profile, update and write back
        final current = await client.from('profiles').select(column).eq('id', childId).single();
        final currentVal = (current[column] as num?)?.toDouble() ?? 0.0;
        final newVal = (currentVal + amount).clamp(0, 999999);
        await client.from('profiles').update({
          column: currencyType == 'stars' ? newVal.toInt() : newVal,
        }).eq('id', childId);
      }
    }
  }
}

class AuthNotifier extends StateNotifier<AuthState> {
  final AuthRepository _repo;

  AuthNotifier(this._repo) : super(const AuthInitial()) {
    _init();
  }

  void _init() {
    if (AuthRepository.bypassLoginForDev) {
      // Auto-authenticate as Madina (Parent) to bypass login screen completely
      state = const AuthAuthenticated(UserProfile(
        id: 'mock-parent-id',
        role: 'parent',
        displayName: 'Мадина (Модар)',
        starsBalance: 120,
        fiatBalance: 50.00,
      ));
      return;
    }
    final client = _repo._client;
    if (client != null && client.auth.currentUser != null) {
      loadProfile(client.auth.currentUser!.id);
    } else if (client == null) {
      // Auto-authenticate as Madina (Parent) in mock mode to bypass login screen
      state = const AuthAuthenticated(UserProfile(
        id: 'mock-parent-id',
        role: 'parent',
        displayName: 'Мадина (Модар)',
        starsBalance: 120,
        fiatBalance: 50.00,
      ));
    } else {
      state = const AuthUnauthenticated();
    }
  }

  Future<void> loadProfile(String userId) async {
    state = const AuthLoading();
    try {
      final profile = await _repo.fetchProfile(userId);
      state = AuthAuthenticated(profile);
    } catch (e) {
      state = AuthError(e.toString());
    }
  }

  Future<void> signIn(String email, String password) async {
    state = const AuthLoading();
    try {
      final profile = await _repo.signIn(email, password);
      state = AuthAuthenticated(profile);
    } catch (e) {
      state = AuthError(e.toString());
    }
  }

  Future<void> signUp(String email, String password, String displayName) async {
    state = const AuthLoading();
    try {
      final profile = await _repo.signUp(email, password, displayName);
      state = AuthAuthenticated(profile);
    } catch (e) {
      state = AuthError(e.toString());
    }
  }

  Future<void> signOut() async {
    state = const AuthLoading();
    try {
      await _repo.signOut();
      state = const AuthUnauthenticated();
    } catch (e) {
      state = AuthError(e.toString());
    }
  }
}
