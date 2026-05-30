// ══════════════════════════════════════════════════════════════════════════════
// App Router — GoRouter Configuration with Feature-First routes
// ══════════════════════════════════════════════════════════════════════════════

import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';

import '../../features/onboarding/presentation/screens/splash_screen.dart';
import '../../features/onboarding/presentation/screens/language_picker_screen.dart';
import '../../features/auth/presentation/screens/login_screen.dart';
import '../../features/auth/presentation/screens/registration_screen.dart';
import '../../features/auth/presentation/screens/pin_screen.dart';
import '../../features/auth/presentation/screens/pin_setup_screen.dart';
import '../../features/tasks/presentation/screens/child_dashboard.dart';
import '../../features/tasks/presentation/screens/child_shell.dart';
import '../../features/tasks/presentation/screens/task_detail_screen.dart';
import '../../features/tasks/presentation/screens/timer_screen.dart';
import '../../features/tasks/presentation/screens/parent_dashboard.dart';
import '../../features/tasks/presentation/screens/create_task_screen.dart';
import '../../features/tasks/presentation/screens/approve_tasks_screen.dart';
import '../../features/wallet/presentation/screens/child_wallet_screen.dart';
import '../../features/wallet/presentation/screens/economy_screen.dart';
import '../../features/wishlist/presentation/screens/child_wishlist_screen.dart';
import '../../features/wishlist/presentation/screens/wishlist_approval_screen.dart';
import '../../features/family/presentation/screens/add_child_screen.dart';
import '../../features/family/presentation/screens/parent_settings_screen.dart';
import '../../features/family/presentation/screens/statistics_screen.dart';
import '../../features/auth/presentation/providers/auth_provider.dart';

final _rootNavigatorKey = GlobalKey<NavigatorState>();
final _shellNavigatorKey = GlobalKey<NavigatorState>();

final appRouterProvider = Provider<GoRouter>((ref) {
  // Watch auth state so GoRouter rebuilds on login/logout
  final authState = ref.watch(authProvider);

  return GoRouter(
    navigatorKey: _rootNavigatorKey,
    initialLocation: '/',
    debugLogDiagnostics: false,
    redirect: (context, state) {
      final location = state.uri.toString();

      // ── Public routes (no auth required) ──────────────────────────
      if (location == '/' || location == '/language-picker') return null;
      if (location == '/login' || location == '/register') return null;
      if (location == '/pin-setup' || location == '/pin') return null;

      // ── Not authenticated → redirect to login ────────────────────
      if (!authState.isAuthenticated) {
        // But skip redirect for onboarding/splash while loading
        if (authState.isLoading) return null;
        return '/login';
      }

      // ── Role-based route access ───────────────────────────────────
      final role = authState.user?.userMetadata?['role'] as String?;

      // Role not yet loaded — skip redirect
      if (role == null) return null;

      // Parent trying to access child routes → redirect to parent dashboard
      if (location.startsWith('/child/') && role != 'child') {
        return '/parent/dashboard';
      }

      // Child trying to access parent routes → redirect to child dashboard
      if (location.startsWith('/parent/') && role != 'parent') {
        return '/child/dashboard';
      }

      return null; // No redirect needed
    },
    routes: [
      // ── Onboarding Flow ──────────────────────────────────────────────
      GoRoute(
        path: '/',
        name: 'splash',
        builder: (context, state) => const SplashScreen(),
      ),
      GoRoute(
        path: '/language-picker',
        name: 'languagePicker',
        builder: (context, state) => const LanguagePickerScreen(),
      ),

      // ── Auth Flow ────────────────────────────────────────────────────
      GoRoute(
        path: '/login',
        name: 'login',
        builder: (context, state) => const LoginScreen(),
      ),
      GoRoute(
        path: '/register',
        name: 'register',
        builder: (context, state) => const RegistrationScreen(),
      ),
      GoRoute(
        path: '/pin-setup',
        name: 'pinSetup',
        builder: (context, state) => const PinSetupScreen(),
      ),
      GoRoute(
        path: '/pin',
        name: 'pin',
        builder: (context, state) => const PinScreen(),
      ),

      // ── Child Shell (with bottom nav) ────────────────────────────────
      ShellRoute(
        navigatorKey: _shellNavigatorKey,
        builder: (context, state, child) => ChildShell(child: child),
        routes: [
          GoRoute(
            path: '/child/dashboard',
            name: 'childDashboard',
            builder: (context, state) => const ChildDashboard(),
          ),
          GoRoute(
            path: '/child/wallet',
            name: 'childWallet',
            builder: (context, state) => const ChildWalletScreen(),
          ),
          GoRoute(
            path: '/child/wishlist',
            name: 'childWishlist',
            builder: (context, state) => const ChildWishlistScreen(),
          ),
        ],
      ),

      // ── Child Task Details ───────────────────────────────────────────
      GoRoute(
        path: '/child/task/:taskId',
        name: 'taskDetail',
        builder: (context, state) {
          final taskId = state.pathParameters['taskId']!;
          return TaskDetailScreen(taskId: taskId);
        },
      ),
      GoRoute(
        path: '/child/timer/:taskId',
        name: 'timer',
        builder: (context, state) {
          final taskId = state.pathParameters['taskId']!;
          final durationMins = int.tryParse(
            state.uri.queryParameters['duration'] ?? '15',
          ) ?? 15;
          return TimerScreen(taskId: taskId, durationMinutes: durationMins);
        },
      ),

      // ── Parent Routes ────────────────────────────────────────────────
      GoRoute(
        path: '/parent/dashboard',
        name: 'parentDashboard',
        builder: (context, state) => const ParentDashboard(),
      ),
      GoRoute(
        path: '/parent/create-task',
        name: 'createTask',
        builder: (context, state) => const CreateTaskScreen(),
      ),
      GoRoute(
        path: '/parent/approve-tasks',
        name: 'approveTasks',
        builder: (context, state) => const ApproveTasksScreen(),
      ),
      GoRoute(
        path: '/parent/economy',
        name: 'economy',
        builder: (context, state) => const EconomyScreen(),
      ),
      GoRoute(
        path: '/parent/wishlist-approval',
        name: 'wishlistApproval',
        builder: (context, state) => const WishlistApprovalScreen(),
      ),
      GoRoute(
        path: '/parent/add-child',
        name: 'addChild',
        builder: (context, state) => const AddChildScreen(),
      ),
      GoRoute(
        path: '/parent/settings',
        name: 'parentSettings',
        builder: (context, state) => const ParentSettingsScreen(),
      ),
      GoRoute(
        path: '/parent/statistics',
        name: 'statistics',
        builder: (context, state) => const StatisticsScreen(),
      ),
    ],
  );
});
