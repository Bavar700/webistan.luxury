// ══════════════════════════════════════════════════════════════════════════════
// App Constants
// ══════════════════════════════════════════════════════════════════════════════

class AppConstants {
  AppConstants._();

  // App Info
  static const String appNameDefault = 'Офарин! Ту метавонӣ!';
  static const String appVersion = '1.0.0';

  // Supabase
  static const String supabaseUrl = String.fromEnvironment(
    'SUPABASE_URL',
    defaultValue: 'https://your-project.supabase.co',
  );
  static const String supabaseAnonKey = String.fromEnvironment(
    'SUPABASE_ANON_KEY',
    defaultValue: 'your-anon-key',
  );

  // Local Storage Keys
  static const String prefLanguage = 'pref_language';
  static const String prefTheme = 'pref_theme';
  static const String prefPin = 'pref_pin';
  static const String prefSession = 'pref_session';

  // Limits (Freemium)
  static const int freeMaxChildren = 1;
  static const int freeMaxParents = 1;
  static const int freeMaxActiveTasks = 3;

  // Currencies
  static const String currencyFiatSymbol = 'TJS';
  static const String currencyStarSymbol = '⭐';
  static const String currencyGoldSymbol = '🏆';
}
