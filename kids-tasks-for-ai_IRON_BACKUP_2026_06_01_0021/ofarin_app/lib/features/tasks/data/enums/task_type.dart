// ══════════════════════════════════════════════════════════════════════════════
// TaskType enum
// ══════════════════════════════════════════════════════════════════════════════

enum TaskType {
  chore('chore'),
  routine('routine'),
  achievement('achievement');

  final String value;
  const TaskType(this.value);

  static TaskType fromValue(String value) {
    return TaskType.values.firstWhere(
      (e) => e.value == value,
      orElse: () => TaskType.chore,
    );
  }
}
