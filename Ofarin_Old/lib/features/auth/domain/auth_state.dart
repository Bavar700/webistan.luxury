enum AppMode {
  none,
  parent,
  child,
}

class UserProfile {
  final String id;
  final String role; // 'parent' or 'child'
  final String? parentId;
  final String displayName;
  final String? avatarUrl;
  final int starsBalance;
  final double fiatBalance;
  final int streakCount;

  const UserProfile({
    required this.id,
    required this.role,
    this.parentId,
    required this.displayName,
    this.avatarUrl,
    this.starsBalance = 0,
    this.fiatBalance = 0.0,
    this.streakCount = 0,
  });

  UserProfile copyWith({
    String? id,
    String? role,
    String? parentId,
    String? displayName,
    String? avatarUrl,
    int? starsBalance,
    double? fiatBalance,
    int? streakCount,
  }) {
    return UserProfile(
      id: id ?? this.id,
      role: role ?? this.role,
      parentId: parentId ?? this.parentId,
      displayName: displayName ?? this.displayName,
      avatarUrl: avatarUrl ?? this.avatarUrl,
      starsBalance: starsBalance ?? this.starsBalance,
      fiatBalance: fiatBalance ?? this.fiatBalance,
      streakCount: streakCount ?? this.streakCount,
    );
  }

  factory UserProfile.fromJson(Map<String, dynamic> json) {
    return UserProfile(
      id: json['id'] as String,
      role: json['role'] as String,
      parentId: json['parent_id'] as String?,
      displayName: json['display_name'] as String,
      avatarUrl: json['avatar_url'] as String?,
      starsBalance: json['stars_balance'] as int? ?? 0,
      fiatBalance: (json['fiat_balance'] as num? ?? 0.0).toDouble(),
      streakCount: json['streak_count'] as int? ?? 0,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'role': role,
      'parent_id': parentId,
      'display_name': displayName,
      'avatar_url': avatarUrl,
      'stars_balance': starsBalance,
      'fiat_balance': fiatBalance,
      'streak_count': streakCount,
    };
  }
}

abstract class AuthState {
  const AuthState();
}

class AuthInitial extends AuthState {
  const AuthInitial();
}

class AuthLoading extends AuthState {
  const AuthLoading();
}

class AuthAuthenticated extends AuthState {
  final UserProfile profile;
  const AuthAuthenticated(this.profile);
}

class AuthUnauthenticated extends AuthState {
  const AuthUnauthenticated();
}

class AuthError extends AuthState {
  final String message;
  const AuthError(this.message);
}
