class CurrencyFormatter {
  CurrencyFormatter._();

  static String formatStars(double amount) {
    final rounded = amount.round();
    return '⭐ $rounded';
  }

  static String formatLocal(double amount) {
    return '${amount.toStringAsFixed(0)} ₽';
  }

  static String formatBoth(double stars, double local) {
    return '${formatStars(stars)} | ${formatLocal(local)}';
  }

  static String formatWithSign(double amount) {
    final prefix = amount >= 0 ? '+' : '';
    return '$prefix${amount.toStringAsFixed(0)}';
  }

  static String formatCompact(double amount) {
    if (amount >= 1000) {
      return '${(amount / 1000).toStringAsFixed(1)}k';
    }
    return amount.toStringAsFixed(0);
  }
}
