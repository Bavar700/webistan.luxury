class RoutePaths {
  RoutePaths._();

  // Authentication & Initial flow
  static const String auth = '/auth';
  static const String modeSelection = '/mode-selection';
  static const String parentPin = '/parent-pin';

  // Parent Mode Screens — FLAT paths (no nested routes)
  static const String parentDashboard = '/parent';
  static const String parentTaskConfig = '/parent/tasks-config';
  static const String parentLedger = '/parent/ledger';
  static const String parentWishlistApproval = '/parent/wishlist-approval';

  // Child Mode Screens — FLAT paths (no nested routes)
  static const String childDashboard = '/child';
  static const String childTasks = '/child/tasks';
  static const String childTimer = '/child/timer';
  static const String childWallet = '/child/wallet';
  static const String childWishlist = '/child/wishlist';
}

class RouteNames {
  RouteNames._();

  static const String auth = 'auth';
  static const String modeSelection = 'modeSelection';
  static const String parentPin = 'parentPin';

  static const String parentDashboard = 'parentDashboard';
  static const String parentTaskConfig = 'parentTaskConfig';
  static const String parentLedger = 'parentLedger';
  static const String parentWishlistApproval = 'parentWishlistApproval';

  static const String childDashboard = 'childDashboard';
  static const String childTasks = 'childTasks';
  static const String childTimer = 'childTimer';
  static const String childWallet = 'childWallet';
  static const String childWishlist = 'childWishlist';
}
