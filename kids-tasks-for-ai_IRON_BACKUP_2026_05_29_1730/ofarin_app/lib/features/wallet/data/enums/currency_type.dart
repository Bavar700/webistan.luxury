// ══════════════════════════════════════════════════════════════════════════════
// CurrencyType enum
// ══════════════════════════════════════════════════════════════════════════════

enum CurrencyType {
  fiat('fiat'),
  star('star'),
  gold('gold');

  final String value;
  const CurrencyType(this.value);

  static CurrencyType fromValue(String value) {
    return CurrencyType.values.firstWhere(
      (e) => e.value == value,
      orElse: () => CurrencyType.star,
    );
  }
}
