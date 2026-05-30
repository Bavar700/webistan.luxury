import 'package:supabase_flutter/supabase_flutter.dart' hide AuthException;
import 'package:logger/logger.dart';

import '../errors/exceptions.dart';

/// Filter operator for multi-column queries
enum FilterOp { eq, gte, lte, neq }

class QueryFilter {
  final String column;
  final dynamic value;
  final FilterOp op;

  const QueryFilter({required this.column, required this.value, this.op = FilterOp.eq});
}

/// Simplified auth result that works for both real and mock API
class AuthResult {
  final String? userId;
  final String? accessToken;
  final Map<String, dynamic>? metadata;

  const AuthResult({this.userId, this.accessToken, this.metadata});
}

/// Abstract base for API clients (real Supabase or mock/demo)
abstract class ApiClientBase {
  Future<AuthResult> signUp(String email, String password, {Map<String, dynamic>? data});
  Future<AuthResult> signIn(String email, String password);
  Future<void> signOut();
  Future<List<Map<String, dynamic>>> query(
    String table, {
    String? column,
    dynamic value,
    String? orderBy,
    bool ascending = true,
    int? limit,
  });
  Future<List<Map<String, dynamic>>> queryMulti(
    String table,
    List<QueryFilter> filters, {
    String? orderBy,
    bool ascending = true,
    int? limit,
  });
  Future<Map<String, dynamic>> insert(String table, Map<String, dynamic> data);
  Future<Map<String, dynamic>> update(
    String table,
    Map<String, dynamic> data,
    String column,
    dynamic value,
  );
  Future<Map<String, dynamic>> upsert(
    String table,
    Map<String, dynamic> data,
    String column,
    dynamic value,
  );
  Future<void> delete(String table, String column, dynamic value);
  String? get currentUserId;
  String? get currentUserEmail;
  /// Switch to a child user (only meaningful in demo mode)
  Future<void> switchToChild();
}

class ApiClient implements ApiClientBase {
  final SupabaseClient _client;
  final Logger _logger;

  ApiClient({
    SupabaseClient? supabaseClient,
    Logger? logger,
  })  : _client = supabaseClient ?? Supabase.instance.client,
        _logger = logger ?? Logger();

  SupabaseClient get supabase => _client;

  String? get currentUserId => _client.auth.currentUser?.id;
  String? get currentUserEmail => _client.auth.currentUser?.email;

  // ── Auth ────────────────────────────────────────────────────────────────

  Future<AuthResult> signUp(
    String email,
    String password, {
    Map<String, dynamic>? data,
  }) async {
    try {
      final response = await _client.auth.signUp(
        email: email,
        password: password,
        data: data,
      );
      return AuthResult(
        userId: response.user?.id,
        accessToken: response.session?.accessToken,
        metadata: response.user?.userMetadata,
      );
    } catch (e) {
      _logger.e('SignUp failed', error: e);
      throw AuthException(message: _parseAuthError(e));
    }
  }

  Future<AuthResult> signIn(String email, String password) async {
    try {
      final response = await _client.auth
          .signInWithPassword(email: email, password: password);
      return AuthResult(
        userId: response.user?.id,
        accessToken: response.session?.accessToken,
        metadata: response.user?.userMetadata,
      );
    } catch (e) {
      _logger.e('SignIn failed', error: e);
      throw AuthException(message: _parseAuthError(e));
    }
  }

  @override
  Future<void> switchToChild() async {
    // No-op in real mode — children log in with their own credentials
  }

  @override
  Future<void> signOut() async {
    try {
      await _client.auth.signOut();
    } catch (e) {
      _logger.e('SignOut failed', error: e);
      throw AuthException(message: 'Failed to sign out');
    }
  }

  // ── Database ────────────────────────────────────────────────────────────

  Future<List<Map<String, dynamic>>> query(
    String table, {
    String? column,
    dynamic value,
    String? orderBy,
    bool ascending = true,
    int? limit,
  }) async {
    try {
      dynamic query = _client.from(table).select();
      if (column != null && value != null) {
        query = query.eq(column, value);
      }
      if (orderBy != null) {
        query = query.order(orderBy, ascending: ascending);
      }
      if (limit != null) {
        query = query.limit(limit);
      }
      return await query;
    } catch (e) {
      _logger.e('Query failed for $table', error: e);
      throw ServerException(message: 'Failed to fetch data from $table');
    }
  }

  /// Query with multiple filters (AND logic) using Supabase chaining
  Future<List<Map<String, dynamic>>> queryMulti(
    String table,
    List<QueryFilter> filters, {
    String? orderBy,
    bool ascending = true,
    int? limit,
  }) async {
    try {
      dynamic query = _client.from(table).select();
      for (final filter in filters) {
        query = query.eq(filter.column, filter.value);
      }
      if (orderBy != null) {
        query = query.order(orderBy, ascending: ascending);
      }
      if (limit != null) {
        query = query.limit(limit);
      }
      return await query;
    } catch (e) {
      _logger.e('QueryMulti failed for $table', error: e);
      throw ServerException(message: 'Failed to fetch data from $table');
    }
  }

  Future<Map<String, dynamic>> insert(
    String table,
    Map<String, dynamic> data,
  ) async {
    try {
      final result = await _client.from(table).insert(data).select().single();
      return result;
    } catch (e) {
      _logger.e('Insert failed for $table', error: e);
      throw ServerException(message: 'Failed to insert into $table');
    }
  }

  Future<Map<String, dynamic>> update(
    String table,
    Map<String, dynamic> data,
    String column,
    dynamic value,
  ) async {
    try {
      final result = await _client
          .from(table)
          .update(data)
          .eq(column, value)
          .select()
          .single();
      return result;
    } catch (e) {
      _logger.e('Update failed for $table', error: e);
      throw ServerException(message: 'Failed to update $table\n$e');
    }
  }

  Future<Map<String, dynamic>> upsert(
    String table,
    Map<String, dynamic> data,
    String column,
    dynamic value,
  ) async {
    try {
      // Merge the column=value condition into the data for upsert
      final row = Map<String, dynamic>.from(data);
      row[column] = value;
      final result = await _client.from(table).upsert(row).select().single();
      return result;
    } catch (e) {
      _logger.e('Upsert failed for $table', error: e);
      throw ServerException(message: 'Failed to upsert $table\n$e');
    }
  }

  Future<void> delete(String table, String column, dynamic value) async {
    try {
      await _client.from(table).delete().eq(column, value);
    } catch (e) {
      _logger.e('Delete failed for $table', error: e);
      throw ServerException(message: 'Failed to delete from $table');
    }
  }

  // ── Helpers ─────────────────────────────────────────────────────────────

  String _parseAuthError(Object error) {
    final message = error.toString().toLowerCase();
    String translated;
    if (message.contains('invalid login credentials')) {
      translated = 'Неверный email или пароль';
    } else if (message.contains('email already registered') ||
        message.contains('user already registered') ||
        message.contains('user already exists')) {
      translated = 'Этот email уже зарегистрирован';
    } else {
      translated = 'Произошла ошибка авторизации';
    }
    // Include original error for debugging
    return '$translated\n\n$error';
  }
}
