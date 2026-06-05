// ══════════════════════════════════════════════════════════════════════════════
// TaskStatus enum
// ══════════════════════════════════════════════════════════════════════════════

enum TaskStatus {
  active('active'),
  pendingApproval('pending_approval'),
  completed('completed'),
  rejected('rejected');

  final String value;
  const TaskStatus(this.value);

  static TaskStatus fromValue(String value) {
    return TaskStatus.values.firstWhere(
      (e) => e.value == value,
      orElse: () => TaskStatus.active,
    );
  }
}
