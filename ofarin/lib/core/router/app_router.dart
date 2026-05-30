import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../state/app_state.dart';

// New Mobile-First Screens
import '../../features/parent/presentation/parent_main_screen.dart';
import '../../features/child/presentation/child_main_screen.dart';

// Import Language Picker for initial route if needed (assuming it exists)
import '../../features/onboarding/presentation/language_picker_screen.dart';

final routerProvider = Provider<GoRouter>((ref) {
  return GoRouter(
    initialLocation: '/parent', // Start in parent mode for MVP testing
    routes: [
      GoRoute(
        path: '/',
        builder: (context, state) => const LanguagePickerScreen(),
      ),
      GoRoute(
        path: '/parent',
        builder: (context, state) => const ParentMainScreen(),
      ),
      GoRoute(
        path: '/child',
        builder: (context, state) => const ChildMainScreen(),
      ),
    ],
  );
});
