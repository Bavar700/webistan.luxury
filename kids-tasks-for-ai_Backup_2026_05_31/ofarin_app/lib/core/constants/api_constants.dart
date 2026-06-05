class ApiConstants {
  ApiConstants._();

  // Auth
  static const String signUp = '/auth/v1/signup';
  static const String signIn = '/auth/v1/token?grant_type=password';
  static const String signOut = '/auth/v1/logout';

  // Tables
  static const String profilesTable = 'profiles';
  static const String tasksTable = 'tasks';
  static const String taskInstancesTable = 'task_instances';
  static const String transactionsTable = 'transactions';
  static const String wishlistItemsTable = 'wishlist_items';
  static const String achievementsTable = 'achievements';
  static const String streaksTable = 'streaks';
}
