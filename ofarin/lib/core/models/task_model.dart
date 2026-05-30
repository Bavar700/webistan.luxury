import 'package:flutter/material.dart';

/// Модели вазифа барои Ofarin
/// Task model — parent assigns tasks to children

class TaskModel {
  final String id;
  final String childId;
  final String parentId;
  final String title;
  final String description;
  final bool isBonus;
  final int? timerDurationMins;
  final DateTime? deadlineAt;
  final int rewardXp;
  final int rewardCoins;
  final double rewardFiat;
  final String? proofImageUrl;
  final String? rejectReason;
  final String status; // 'active', 'pending_approval', 'completed', 'rejected'
  final String difficulty; // 'easy', 'medium', 'hard'
  final DateTime createdAt;
  final DateTime updatedAt;

  const TaskModel({
    required this.id,
    required this.childId,
    required this.parentId,
    required this.title,
    required this.description,
    this.isBonus = false,
    this.timerDurationMins,
    this.deadlineAt,
    this.rewardXp = 10,
    this.rewardCoins = 5,
    this.rewardFiat = 0.0,
    this.proofImageUrl,
    this.rejectReason,
    this.status = 'active',
    this.difficulty = 'easy',
    required this.createdAt,
    required this.updatedAt,
  });

  TaskModel copyWith({
    String? id,
    String? childId,
    String? parentId,
    String? title,
    String? description,
    bool? isBonus,
    int? timerDurationMins,
    DateTime? deadlineAt,
    int? rewardXp,
    int? rewardCoins,
    double? rewardFiat,
    String? proofImageUrl,
    String? rejectReason,
    String? status,
    String? difficulty,
    DateTime? createdAt,
    DateTime? updatedAt,
  }) {
    return TaskModel(
      id: id ?? this.id,
      childId: childId ?? this.childId,
      parentId: parentId ?? this.parentId,
      title: title ?? this.title,
      description: description ?? this.description,
      isBonus: isBonus ?? this.isBonus,
      timerDurationMins: timerDurationMins ?? this.timerDurationMins,
      deadlineAt: deadlineAt ?? this.deadlineAt,
      rewardXp: rewardXp ?? this.rewardXp,
      rewardCoins: rewardCoins ?? this.rewardCoins,
      rewardFiat: rewardFiat ?? this.rewardFiat,
      proofImageUrl: proofImageUrl ?? this.proofImageUrl,
      rejectReason: rejectReason ?? this.rejectReason,
      status: status ?? this.status,
      difficulty: difficulty ?? this.difficulty,
      createdAt: createdAt ?? this.createdAt,
      updatedAt: updatedAt ?? this.updatedAt,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'child_id': childId,
      'parent_id': parentId,
      'title': title,
      'description': description,
      'is_bonus': isBonus,
      'timer_duration_mins': timerDurationMins,
      'deadline_at': deadlineAt?.toIso8601String(),
      'reward_xp': rewardXp,
      'reward_coins': rewardCoins,
      'reward_fiat': rewardFiat,
      'proof_image_url': proofImageUrl,
      'reject_reason': rejectReason,
      'status': status,
      'difficulty': difficulty,
      'created_at': createdAt.toIso8601String(),
      'updated_at': updatedAt.toIso8601String(),
    };
  }

  factory TaskModel.fromJson(Map<String, dynamic> json) {
    return TaskModel(
      id: json['id'] as String,
      childId: json['child_id'] as String,
      parentId: json['parent_id'] as String,
      title: json['title'] as String,
      description: json['description'] as String,
      isBonus: (json['is_bonus'] as bool?) ?? false,
      timerDurationMins: json['timer_duration_mins'] as int?,
      deadlineAt: json['deadline_at'] != null
          ? DateTime.parse(json['deadline_at'] as String)
          : null,
      rewardXp: (json['reward_xp'] as int?) ?? 10,
      rewardCoins: (json['reward_coins'] as int?) ?? 5,
      rewardFiat: (json['reward_fiat'] as num?)?.toDouble() ?? 0.0,
      proofImageUrl: json['proof_image_url'] as String?,
      rejectReason: json['reject_reason'] as String?,
      status: (json['status'] as String?) ?? 'active',
      difficulty: (json['difficulty'] as String?) ?? 'easy',
      createdAt: DateTime.parse(json['created_at'] as String),
      updatedAt: DateTime.parse(json['updated_at'] as String),
    );
  }

  /// Нишонаи мушкилӣ 🎮
  static String getDifficultyIcon(String difficulty) {
    switch (difficulty) {
      case 'easy':
        return '⚡';
      case 'medium':
        return '⚔️';
      case 'hard':
        return '🏆';
      default:
        return '⚡';
    }
  }

  /// Ранги ҳолат
  static Color getStatusColor(String status) {
    switch (status) {
      case 'active':
        return const Color(0xFF4CAF50); // Сабз — фаъол
      case 'pending_approval':
        return const Color(0xFFFF9800); // Норанҷӣ — интизорӣ
      case 'completed':
        return const Color(0xFF2196F3); // Кабуд — иҷрошуда
      case 'rejected':
        return const Color(0xFFF44336); // Сурх — радшуда
      default:
        return const Color(0xFF9E9E9E); // Хокистарӣ
    }
  }

  /// Нишонаи мушкилии ин вазифа
  String get difficultyIcon => getDifficultyIcon(difficulty);

  /// Ранги ҳолати ин вазифа
  Color get statusColor => getStatusColor(status);

  @override
  String toString() {
    return 'TaskModel(id: $id, title: $title, status: $status, difficulty: $difficulty)';
  }

  @override
  bool operator ==(Object other) {
    if (identical(this, other)) return true;
    return other is TaskModel && other.id == id;
  }

  @override
  int get hashCode => id.hashCode;
}
