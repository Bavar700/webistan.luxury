class Validators {
  Validators._();

  static String? email(String? value) {
    if (value == null || value.isEmpty) return 'Введите email';
    final regex = RegExp(r'^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$');
    if (!regex.hasMatch(value)) return 'Неверный формат email';
    return null;
  }

  static String? password(String? value) {
    if (value == null || value.isEmpty) return 'Введите пароль';
    if (value.length < 6) return 'Пароль должен быть минимум 6 символов';
    return null;
  }

  static String? name(String? value) {
    if (value == null || value.isEmpty) return 'Введите имя';
    if (value.length < 2) return 'Имя должно быть минимум 2 символа';
    return null;
  }

  static String? pin(String? value) {
    if (value == null || value.isEmpty) return 'Введите PIN';
    if (value.length != 4) return 'PIN должен быть 4 цифры';
    if (!RegExp(r'^\d{4}$').hasMatch(value)) return 'PIN должен содержать только цифры';
    return null;
  }

  static String? amount(String? value) {
    if (value == null || value.isEmpty) return 'Введите сумму';
    final amount = double.tryParse(value);
    if (amount == null || amount < 0) return 'Введите корректную сумму';
    return null;
  }

  static String? duration(String? value) {
    if (value == null || value.isEmpty) return 'Введите время';
    final minutes = int.tryParse(value);
    if (minutes == null || minutes < 1) return 'Минимум 1 минута';
    if (minutes > 120) return 'Максимум 120 минут';
    return null;
  }
}
