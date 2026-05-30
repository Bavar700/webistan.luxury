/// Модели ҳамён барои Ofarin
/// Wallet model — tracks Stars (XP), Coins, and Fiat (TJS)

class WalletModel {
  final String childId;
  final int balanceStars; // ⭐ XP
  final int balanceCoins; // 🪙 Gold/Coins
  final double balanceFiat; // 💵 Real money TJS

  const WalletModel({
    required this.childId,
    this.balanceStars = 0,
    this.balanceCoins = 0,
    this.balanceFiat = 0.0,
  });

  WalletModel copyWith({
    String? childId,
    int? balanceStars,
    int? balanceCoins,
    double? balanceFiat,
  }) {
    return WalletModel(
      childId: childId ?? this.childId,
      balanceStars: balanceStars ?? this.balanceStars,
      balanceCoins: balanceCoins ?? this.balanceCoins,
      balanceFiat: balanceFiat ?? this.balanceFiat,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'child_id': childId,
      'balance_stars': balanceStars,
      'balance_coins': balanceCoins,
      'balance_fiat': balanceFiat,
    };
  }

  factory WalletModel.fromJson(Map<String, dynamic> json) {
    return WalletModel(
      childId: json['child_id'] as String,
      balanceStars: (json['balance_stars'] as int?) ?? 0,
      balanceCoins: (json['balance_coins'] as int?) ?? 0,
      balanceFiat: (json['balance_fiat'] as num?)?.toDouble() ?? 0.0,
    );
  }

  /// Санҷиши имконияти харид 💰
  /// [amount] — миқдори лозимӣ
  /// [currencyType] — навъи асъор: 'stars', 'coins', 'fiat'
  bool canAfford(int amount, String currencyType) {
    switch (currencyType) {
      case 'stars':
        return balanceStars >= amount;
      case 'coins':
        return balanceCoins >= amount;
      case 'fiat':
        return balanceFiat >= amount.toDouble();
      default:
        return false;
    }
  }

  /// Формати намоиш барои ситораҳо ⭐
  String get formattedStars => '$balanceStars ⭐';

  /// Формати намоиш барои тангаҳо 🪙
  String get formattedCoins => '$balanceCoins 🪙';

  /// Формати намоиш барои пули воқеӣ 💵
  String get formattedFiat => '${balanceFiat.toStringAsFixed(2)} TJS';

  @override
  String toString() {
    return 'WalletModel(childId: $childId, stars: $balanceStars, coins: $balanceCoins, fiat: $balanceFiat)';
  }

  @override
  bool operator ==(Object other) {
    if (identical(this, other)) return true;
    return other is WalletModel && other.childId == childId;
  }

  @override
  int get hashCode => childId.hashCode;
}
