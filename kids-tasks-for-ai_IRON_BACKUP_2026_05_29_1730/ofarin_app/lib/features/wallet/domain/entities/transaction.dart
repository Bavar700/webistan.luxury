// ══════════════════════════════════════════════════════════════════════════════
// Transaction Domain Entity
// ══════════════════════════════════════════════════════════════════════════════

class Transaction {
  final String id;
  final String type;
  final String currency;
  final double amount;
  final String description;
  final DateTime createdAt;

  const Transaction({
    required this.id,
    required this.type,
    required this.currency,
    required this.amount,
    this.description = '',
    required this.createdAt,
  });

  bool get isEarned => type == 'earned';
  bool get isSpent => type == 'spent';
}
