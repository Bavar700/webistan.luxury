// ══════════════════════════════════════════════════════════════════════════════
// UserProfile — Domain entity for a user profile
// ══════════════════════════════════════════════════════════════════════════════

class UserProfile {
  final String id;
  final String familyId;
  final String role;
  final String name;
  final String avatarUrl;
  final String preferredLanguage;

  const UserProfile({
    required this.id,
    required this.familyId,
    required this.role,
    this.name = '',
    this.avatarUrl = '',
    this.preferredLanguage = 'ru',
  });

  bool get isParent => role == 'parent';
  bool get isChild => role == 'child';
}
