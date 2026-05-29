// ══════════════════════════════════════════════════════════════════════════════
// Task Domain Entity
// ══════════════════════════════════════════════════════════════════════════════

import '../../data/enums/task_status.dart';

class Task {
  final String id;
  final String title;
  final String description;
  final bool isBonus;
  final int? timerDurationMins;
  final DateTime? deadlineAt;
  final double rewardAmount;
  final String rewardCurrency;
  final double penaltyAmount;
  final String penaltyCurrency;
  final TaskStatus status;

  const Task({
    required this.id,
    required this.title,
    this.description = '',
    this.isBonus = false,
    this.timerDurationMins,
    this.deadlineAt,
    this.rewardAmount = 1,
    this.rewardCurrency = 'star',
    this.penaltyAmount = 0,
    this.penaltyCurrency = 'star',
    this.status = TaskStatus.active,
  });

  bool get hasTimer => timerDurationMins != null && timerDurationMins! > 0;
  bool get hasDeadline => deadlineAt != null;
  bool get hasPenalty => penaltyAmount > 0;
}
