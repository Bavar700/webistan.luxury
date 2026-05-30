import 'dart:math';

/// Модели оила барои Ofarin
/// Family model — groups parents and children together

class FamilyModel {
  final String id;
  final String name;
  final String inviteCode;
  final List<String> memberIds;
  final DateTime createdAt;

  const FamilyModel({
    required this.id,
    required this.name,
    required this.inviteCode,
    required this.memberIds,
    required this.createdAt,
  });

  FamilyModel copyWith({
    String? id,
    String? name,
    String? inviteCode,
    List<String>? memberIds,
    DateTime? createdAt,
  }) {
    return FamilyModel(
      id: id ?? this.id,
      name: name ?? this.name,
      inviteCode: inviteCode ?? this.inviteCode,
      memberIds: memberIds ?? List<String>.from(this.memberIds),
      createdAt: createdAt ?? this.createdAt,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'name': name,
      'invite_code': inviteCode,
      'member_ids': memberIds,
      'created_at': createdAt.toIso8601String(),
    };
  }

  factory FamilyModel.fromJson(Map<String, dynamic> json) {
    return FamilyModel(
      id: json['id'] as String,
      name: json['name'] as String,
      inviteCode: json['invite_code'] as String,
      memberIds: (json['member_ids'] as List<dynamic>)
          .map((e) => e as String)
          .toList(),
      createdAt: DateTime.parse(json['created_at'] as String),
    );
  }

  /// Тавлиди рамзи даъват — 6 аломати алфанумерикӣ 🔑
  static String generateInviteCode() {
    const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    final random = Random.secure();
    return List.generate(6, (_) => chars[random.nextInt(chars.length)]).join();
  }

  /// Шумораи аъзоёни оила 👨‍👩‍👧‍👦
  int get memberCount => memberIds.length;

  @override
  String toString() {
    return 'FamilyModel(id: $id, name: $name, members: ${memberIds.length})';
  }

  @override
  bool operator ==(Object other) {
    if (identical(this, other)) return true;
    return other is FamilyModel && other.id == id;
  }

  @override
  int get hashCode => id.hashCode;
}
