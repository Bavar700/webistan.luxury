// ══════════════════════════════════════════════════════════════════════════════
// Task Instance Model — Tracks a specific completion attempt of a task
// ══════════════════════════════════════════════════════════════════════════════

import '../enums/task_status.dart';

class TaskInstanceModel {
  final String id;
  final String taskId;
  final String childId;
  final DateTime startedAt;
  final DateTime? completedAt;
  final int? timerSecondsUsed;
  final String? proofImageUrl;
  final String? note;
  final TaskStatus status;

  const TaskInstanceModel({
    required this.id,
    required this.taskId,
    required this.childId,
    required this.startedAt,
    this.completedAt,
    this.timerSecondsUsed,
    this.proofImageUrl,
    this.note,
    this.status = TaskStatus.active,
  });

  factory TaskInstanceModel.fromJson(Map<String, dynamic> json) {
    return TaskInstanceModel(
      id: json['id'] as String,
      taskId: json['task_id'] as String,
      childId: json['child_id'] as String,
      startedAt: DateTime.parse(json['started_at'] as String),
      completedAt: json['completed_at'] != null
          ? DateTime.parse(json['completed_at'] as String)
          : null,
      timerSecondsUsed: json['timer_seconds_used'] as int?,
      proofImageUrl: json['proof_image_url'] as String?,
      note: json['note'] as String?,
      status: TaskStatus.fromValue(json['status'] as String? ?? 'active'),
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'task_id': taskId,
      'child_id': childId,
      'started_at': startedAt.toIso8601String(),
      'completed_at': completedAt?.toIso8601String(),
      'timer_seconds_used': timerSecondsUsed,
      'proof_image_url': proofImageUrl,
      'note': note,
      'status': status.value,
    };
  }
}
