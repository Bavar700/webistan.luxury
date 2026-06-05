// ══════════════════════════════════════════════════════════════════════════════
// Transaction Model — Data layer representation of a transaction
// ══════════════════════════════════════════════════════════════════════════════

import '../enums/transaction_type.dart';
import '../enums/currency_type.dart';

class TransactionModel {
  final String id;
  final String childId;
  final String? taskId;
  final TransactionType type;
  final CurrencyType currency;
  final double amount;
  final String description;
  final DateTime createdAt;

  const TransactionModel({
    required this.id,
    required this.childId,
    this.taskId,
    required this.type,
    required this.currency,
    required this.amount,
    this.description = '',
    required this.createdAt,
  });

  factory TransactionModel.fromJson(Map<String, dynamic> json) {
    return TransactionModel(
      id: json['id'] as String,
      childId: json['child_id'] as String,
      taskId: json['task_id'] as String?,
      type: TransactionType.fromValue(json['type'] as String? ?? 'earned'),
      currency: CurrencyType.fromValue(json['currency'] as String? ?? 'star'),
      amount: (json['amount'] as num?)?.toDouble() ?? 0,
      description: json['description'] as String? ?? '',
      createdAt: DateTime.parse(json['created_at'] as String),
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'child_id': childId,
      'task_id': taskId,
      'type': type.value,
      'currency': currency.value,
      'amount': amount,
      'description': description,
      'created_at': createdAt.toIso8601String(),
    };
  }
}
