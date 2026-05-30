/// Модели корбар барои Ofarin
/// User model for parent/child accounts

class UserModel {
  final String id;
  final String name;
  final String role; // 'parent' or 'child'
  final String familyId;
  final String avatarEmoji;
  final int level;
  final int totalXp;
  final String preferredLanguage;

  const UserModel({
    required this.id,
    required this.name,
    required this.role,
    required this.familyId,
    this.avatarEmoji = '🦁',
    this.level = 1,
    this.totalXp = 0,
    this.preferredLanguage = 'tg',
  });

  UserModel copyWith({
    String? id,
    String? name,
    String? role,
    String? familyId,
    String? avatarEmoji,
    int? level,
    int? totalXp,
    String? preferredLanguage,
  }) {
    return UserModel(
      id: id ?? this.id,
      name: name ?? this.name,
      role: role ?? this.role,
      familyId: familyId ?? this.familyId,
      avatarEmoji: avatarEmoji ?? this.avatarEmoji,
      level: level ?? this.level,
      totalXp: totalXp ?? this.totalXp,
      preferredLanguage: preferredLanguage ?? this.preferredLanguage,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'name': name,
      'role': role,
      'family_id': familyId,
      'avatar_emoji': avatarEmoji,
      'level': level,
      'total_xp': totalXp,
      'preferred_language': preferredLanguage,
    };
  }

  factory UserModel.fromJson(Map<String, dynamic> json) {
    return UserModel(
      id: json['id'] as String,
      name: json['name'] as String,
      role: json['role'] as String,
      familyId: json['family_id'] as String,
      avatarEmoji: (json['avatar_emoji'] as String?) ?? '🦁',
      level: (json['level'] as int?) ?? 1,
      totalXp: (json['total_xp'] as int?) ?? 0,
      preferredLanguage: (json['preferred_language'] as String?) ?? 'tg',
    );
  }

  /// Factory аз Supabase row — калидҳои snake_case
  factory UserModel.fromSupabase(Map<String, dynamic> row) {
    return UserModel(
      id: row['id'] as String,
      name: row['name'] as String,
      role: row['role'] as String,
      familyId: row['family_id'] as String,
      avatarEmoji: (row['avatar_emoji'] as String?) ?? '🦁',
      level: (row['level'] as int?) ?? 1,
      totalXp: (row['total_xp'] as int?) ?? 0,
      preferredLanguage: (row['preferred_language'] as String?) ?? 'tg',
    );
  }

  @override
  String toString() {
    return 'UserModel(id: $id, name: $name, role: $role, level: $level, xp: $totalXp)';
  }

  @override
  bool operator ==(Object other) {
    if (identical(this, other)) return true;
    return other is UserModel && other.id == id;
  }

  @override
  int get hashCode => id.hashCode;
}
