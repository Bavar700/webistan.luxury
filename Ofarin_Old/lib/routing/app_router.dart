import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../constants/app_colors.dart';
import '../features/auth/data/auth_repository.dart';
import '../features/auth/domain/auth_state.dart';
import '../features/auth/presentation/sign_in_screen.dart';
import '../features/auth/presentation/mode_selection_screen.dart';
import '../features/auth/presentation/pin_code_screen.dart';
import '../features/profile/presentation/parent_dashboard_screen.dart';
import '../features/profile/presentation/child_dashboard_screen.dart';
import '../features/tasks/presentation/parent_task_config_screen.dart';
import '../features/tasks/presentation/child_tasks_screen.dart';
import '../features/tasks/presentation/child_timer_screen.dart';
import '../features/wishlist/presentation/child_wishlist_screen.dart';
import '../features/wishlist/presentation/parent_wishlist_approval_screen.dart';
import '../features/economy/presentation/child_wallet_screen.dart';
import '../features/economy/presentation/parent_ledger_screen.dart';
import 'route_constants.dart';

// Riverpod provider for GoRouter instance
final appRouterProvider = Provider<GoRouter>((ref) {
  final authState = ref.watch(authStateProvider);

  return GoRouter(
    initialLocation: RoutePaths.modeSelection,
    debugLogDiagnostics: false,

    // Auth redirection guard
    redirect: (context, state) {
      final isAuthenticated = authState is AuthAuthenticated;
      final isLoggingIn = state.matchedLocation == RoutePaths.auth;

      if (!isAuthenticated) {
        return isLoggingIn ? null : RoutePaths.auth;
      }

      if (isAuthenticated && isLoggingIn) {
        return RoutePaths.modeSelection;
      }

      return null;
    },

    // FLAT route structure — no nested routes to avoid path building bugs
    routes: [
      GoRoute(
        path: RoutePaths.auth,
        name: RouteNames.auth,
        builder: (context, state) => const SignInScreen(),
      ),

      GoRoute(
        path: RoutePaths.modeSelection,
        name: RouteNames.modeSelection,
        builder: (context, state) => const ModeSelectionScreen(),
      ),

      GoRoute(
        path: RoutePaths.parentPin,
        name: RouteNames.parentPin,
        builder: (context, state) => const PinCodeScreen(),
      ),

      // Parent screens (flat)
      GoRoute(
        path: RoutePaths.parentDashboard,
        name: RouteNames.parentDashboard,
        builder: (context, state) => const ParentDashboardScreen(),
      ),
      GoRoute(
        path: RoutePaths.parentTaskConfig,
        name: RouteNames.parentTaskConfig,
        builder: (context, state) => const ParentTaskConfigScreen(),
      ),
      GoRoute(
        path: RoutePaths.parentLedger,
        name: RouteNames.parentLedger,
        builder: (context, state) => const ParentLedgerScreen(),
      ),
      GoRoute(
        path: RoutePaths.parentWishlistApproval,
        name: RouteNames.parentWishlistApproval,
        builder: (context, state) => const ParentWishlistApprovalScreen(),
      ),

      // Child screens (flat)
      GoRoute(
        path: RoutePaths.childDashboard,
        name: RouteNames.childDashboard,
        builder: (context, state) => const ChildDashboardScreen(),
      ),
      GoRoute(
        path: RoutePaths.childTasks,
        name: RouteNames.childTasks,
        builder: (context, state) => const ChildTasksScreen(),
      ),
      GoRoute(
        path: RoutePaths.childTimer,
        name: RouteNames.childTimer,
        builder: (context, state) => ChildTimerScreen(
          timerData: (state.extra as Map<String, dynamic>?) ?? {
            'taskId': '',
            'title': 'Математика',
            'duration': 1200,
          },
        ),
      ),
      GoRoute(
        path: RoutePaths.childWallet,
        name: RouteNames.childWallet,
        builder: (context, state) => const ChildWalletScreen(),
      ),
      GoRoute(
        path: RoutePaths.childWishlist,
        name: RouteNames.childWishlist,
        builder: (context, state) => const ChildWishlistScreen(),
      ),
    ],
  );
});

// Simple placeholder screen for routes under development
class PlaceholderScreen extends StatelessWidget {
  final String title;
  const PlaceholderScreen({super.key, required this.title});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(title),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios_new_rounded),
          onPressed: () => context.go(RoutePaths.modeSelection),
        ),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Icon(Icons.handyman_rounded, size: 64, color: AppColors.primary),
            const SizedBox(height: 16),
            Text(title, style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold)),
            const SizedBox(height: 8),
            const Text('Дар марҳилаи иҷрошавӣ...', style: TextStyle(color: Colors.grey)),
          ],
        ),
      ),
    );
  }
}
