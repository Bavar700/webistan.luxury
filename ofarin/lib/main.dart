import 'dart:async';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:easy_localization/easy_localization.dart';
import 'package:supabase_flutter/supabase_flutter.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:flutter_localizations/flutter_localizations.dart';
import 'core/theme/app_theme.dart';
import 'core/router/app_router.dart';
import 'core/state/app_state.dart';

void main() async {
  runZonedGuarded(() async {
    WidgetsFlutterBinding.ensureInitialized();
    await EasyLocalization.ensureInitialized();

  ErrorWidget.builder = (FlutterErrorDetails details) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        backgroundColor: Colors.red.shade900,
        body: SafeArea(
          child: Padding(
            padding: const EdgeInsets.all(20),
            child: SingleChildScrollView(
              child: SelectableText(
                'ХАТОГӢ РУХ ДОД!\n\n${details.exceptionAsString()}\n\n${details.stack?.toString() ?? ''}',
                style: const TextStyle(color: Colors.white, fontSize: 14),
              ),
            ),
          ),
        ),
      ),
    );
  };

  // Initialize Supabase (User to provide keys later)
  try {
    await Supabase.initialize(
      url: 'https://placeholder.supabase.co',
      anonKey: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSJ9.fake_signature', // Must be valid JWT format
    );
  } catch (e) {
    debugPrint('Supabase init skipped/failed: $e');
  }

  // Initialize SharedPreferences
  final prefs = await SharedPreferences.getInstance();

    runApp(
      ProviderScope(
        overrides: [
          sharedPreferencesProvider.overrideWithValue(prefs),
        ],
        child: EasyLocalization(
          supportedLocales: const [
            Locale('tg'),
            Locale('ru'),
            Locale('en'),
            Locale('uz'),
            Locale('kk'),
            Locale('ky'),
            Locale('tk'),
          ],
          path: 'assets/translations',
          fallbackLocale: const Locale('tg'),
          startLocale: const Locale('tg'),
          child: const OfarinApp(),
        ),
      ),
    );
  }, (error, stack) {
    runApp(
      MaterialApp(
        home: Scaffold(
          backgroundColor: Colors.red.shade900,
          body: SingleChildScrollView(
            child: Padding(
              padding: const EdgeInsets.all(20),
              child: SelectableText(
                'FATAL STARTUP ERROR!\n\n$error\n\n$stack',
                style: const TextStyle(color: Colors.white, fontSize: 16),
              ),
            ),
          ),
        ),
      ),
    );
  });
}

class OfarinApp extends ConsumerWidget {
  const OfarinApp({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    // Read the router configuration from Riverpod
    final router = ref.watch(routerProvider);

    return MaterialApp.router(
      debugShowCheckedModeBanner: false,
      builder: (context, child) {
        if (child == null) return const SizedBox.shrink();
        return SelectionArea(child: child);
      },
      localizationsDelegates: [
        GlobalMaterialLocalizations.delegate,
        GlobalWidgetsLocalizations.delegate,
        GlobalCupertinoLocalizations.delegate,
        ...context.localizationDelegates,
      ],
      supportedLocales: context.supportedLocales,
      locale: context.locale,
      title: 'Ofarin',
      theme: AppTheme.darkTheme,
      routerConfig: router, // Setup GoRouter
    );
  }
}
