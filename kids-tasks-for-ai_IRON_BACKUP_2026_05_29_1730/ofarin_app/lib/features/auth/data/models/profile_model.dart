// ══════════════════════════════════════════════════════════════════════════════
// Profile Model — Data layer representation of a user profile
// ══════════════════════════════════════════════════════════════════════════════

class ProfileModel {
  final String id;
  final String familyId;
  final String role; // 'parent' | 'child'
  final String name;
  final String avatarUrl;
  final String preferredLanguage;
  final DateTime? createdAt;
  final DateTime? updatedAt;

  const ProfileModel({
    required this.id,
    required this.familyId,
    required this.role,
    this.name = '',
    this.avatarUrl = '',
    this.preferredLanguage = 'ru',
    this.createdAt,
    this.updatedAt,
  });

  factory ProfileModel.fromJson(Map<String, dynamic> json) {
    return ProfileModel(
      id: json['id'] as String,
      familyId: json['family_id'] as String,
      role: json['role'] as String,
      name: json['name'] as String? ?? '',
      avatarUrl: json['avatar_url'] as String? ?? '',
      preferredLanguage: json['preferred_language'] as String? ?? 'ru',
      createdAt: json['created_at'] != null
          ? DateTime.parse(json['created_at'] as String)
          : null,
      updatedAt: json['updated_at'] != null
          ? DateTime.parse(json['updated_at'] as String)
          : null,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'family_id': familyId,
      'role': role,
      'name': name,
      'avatar_url': avatarUrl,
      'preferred_language': preferredLanguage,
    };
  }
}
