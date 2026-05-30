// ══════════════════════════════════════════════════════════════════════════════
// TransactionType enum
// ══════════════════════════════════════════════════════════════════════════════

enum TransactionType {
  earned('earned'),
  spent('spent'),
  penalty('penalty');

  final String value;
  const TransactionType(this.value);

  static TransactionType fromValue(String value) {
    return TransactionType.values.firstWhere(
      (e) => e.value == value,
      orElse: () => TransactionType.earned,
    );
  }
}
