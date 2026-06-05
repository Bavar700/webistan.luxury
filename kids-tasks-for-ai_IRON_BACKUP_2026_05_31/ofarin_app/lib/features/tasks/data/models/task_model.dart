// ══════════════════════════════════════════════════════════════════════════════
// Task Model — Data layer representation of a task
// ══════════════════════════════════════════════════════════════════════════════

import '../enums/task_status.dart';

class TaskModel {
  final String id;
  final String childId;
  final String parentId;
  final String title;
  final String description;
  final bool isBonus;
  final int? timerDurationMins;
  final DateTime? deadlineAt;
  final double rewardAmount;
  final String rewardCurrency;
  final double penaltyAmount;
  final String penaltyCurrency;
  final String? proofImageUrl;
  final String? rejectReason;
  final TaskStatus status;
  final DateTime? createdAt;
  final DateTime? updatedAt;

  const TaskModel({
    required this.id,
    required this.childId,
    required this.parentId,
    required this.title,
    this.description = '',
    this.isBonus = false,
    this.timerDurationMins,
    this.deadlineAt,
    this.rewardAmount = 1,
    this.rewardCurrency = 'star',
    this.penaltyAmount = 0,
    this.penaltyCurrency = 'star',
    this.proofImageUrl,
    this.rejectReason,
    this.status = TaskStatus.active,
    this.createdAt,
    this.updatedAt,
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
    double? rewardAmount,
    String? rewardCurrency,
    double? penaltyAmount,
    String? penaltyCurrency,
    String? proofImageUrl,
    String? rejectReason,
    TaskStatus? status,
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
      rewardAmount: rewardAmount ?? this.rewardAmount,
      rewardCurrency: rewardCurrency ?? this.rewardCurrency,
      penaltyAmount: penaltyAmount ?? this.penaltyAmount,
      penaltyCurrency: penaltyCurrency ?? this.penaltyCurrency,
      proofImageUrl: proofImageUrl ?? this.proofImageUrl,
      rejectReason: rejectReason ?? this.rejectReason,
      status: status ?? this.status,
      createdAt: createdAt ?? this.createdAt,
      updatedAt: updatedAt ?? this.updatedAt,
    );
  }

  factory TaskModel.fromJson(Map<String, dynamic> json) {
    return TaskModel(
      id: json['id'] as String,
      childId: json['child_id'] as String,
      parentId: json['parent_id'] as String,
      title: json['title'] as String,
      description: json['description'] as String? ?? '',
      isBonus: json['is_bonus'] as bool? ?? false,
      timerDurationMins: json['timer_duration_mins'] as int?,
      deadlineAt: json['deadline_at'] != null ? DateTime.parse(json['deadline_at'] as String) : null,
      rewardAmount: (json['reward_amount'] as num?)?.toDouble() ?? 1,
      rewardCurrency: json['reward_currency'] as String? ?? 'star',
      penaltyAmount: (json['penalty_amount'] as num?)?.toDouble() ?? 0,
      penaltyCurrency: json['penalty_currency'] as String? ?? 'star',
      proofImageUrl: json['proof_image_url'] as String?,
      rejectReason: json['reject_reason'] as String?,
      status: TaskStatus.fromValue(json['status'] as String? ?? 'active'),
      createdAt: json['created_at'] != null ? DateTime.parse(json['created_at'] as String) : null,
      updatedAt: json['updated_at'] != null ? DateTime.parse(json['updated_at'] as String) : null,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'child_id': childId,
      'parent_id': parentId,
      'title': title,
      'description': description,
      'is_bonus': isBonus,
      'timer_duration_mins': timerDurationMins,
      'deadline_at': deadlineAt?.toIso8601String(),
      'reward_amount': rewardAmount,
      'reward_currency': rewardCurrency,
      'penalty_amount': penaltyAmount,
      'penalty_currency': penaltyCurrency,
      'proof_image_url': proofImageUrl,
      'reject_reason': rejectReason,
      'status': status.value,
    };
  }
}
