// ══════════════════════════════════════════════════════════════════════════════
// Task Instance Domain Entity
// ══════════════════════════════════════════════════════════════════════════════

import '../../data/enums/task_status.dart';

class TaskInstance {
  final String id;
  final String taskId;
  final DateTime startedAt;
  final DateTime? completedAt;
  final int? timerSecondsUsed;
  final String? proofImageUrl;
  final TaskStatus status;

  const TaskInstance({
    required this.id,
    required this.taskId,
    required this.startedAt,
    this.completedAt,
    this.timerSecondsUsed,
    this.proofImageUrl,
    this.status = TaskStatus.active,
  });

  bool get isPending => status == TaskStatus.pendingApproval;
  bool get isCompleted => status == TaskStatus.completed;
  bool get hasProof => proofImageUrl != null && proofImageUrl!.isNotEmpty;
}
