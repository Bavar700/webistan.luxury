// ══════════════════════════════════════════════════════════════════════════════
// Офарин! Ту метавонӣ! — Main Entry Point
// ══════════════════════════════════════════════════════════════════════════════

import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:flutter_dotenv/flutter_dotenv.dart';
import 'package:supabase_flutter/supabase_flutter.dart';
import 'package:logger/logger.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'app.dart';
import 'core/constants/app_constants.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  // ── Log all Flutter errors to the browser console ──────────────
  FlutterError.onError = (FlutterErrorDetails details) {
    FlutterError.presentError(details);
    // Also log to browser console for easy copying
    Logger().e(
      'Flutter Error: ${details.exception}\n'
      'Stack: ${details.stack}',
    );
    // Print to JavaScript console for easy debugging
    debugPrint('═══ FLUTTER ERROR ═══');
    debugPrint('${details.exception}');
    if (details.stack != null) {
      debugPrint('${details.stack}');
    }
  };

  // ── Show errors as copyable text on screen ────────────────────
  ErrorWidget.builder = (FlutterErrorDetails details) {
    return Material(
      color: Colors.black,
      child: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(16),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const SizedBox(height: 20),
              const Icon(Icons.error_outline, color: Colors.redAccent, size: 48),
              const SizedBox(height: 12),
              const Text(
                '⚠️ Ошибка в приложении',
                style: TextStyle(
                  color: Colors.white,
                  fontSize: 20,
                  fontWeight: FontWeight.bold,
                ),
              ),
              const SizedBox(height: 8),
              const Text(
                'Текст ошибки можно выделить и скопировать ниже:',
                style: TextStyle(color: Colors.grey, fontSize: 14),
              ),
              const SizedBox(height: 16),
              Expanded(
                flex: 2,
                child: Container(
                  padding: const EdgeInsets.all(12),
                  decoration: BoxDecoration(
                    color: const Color(0xFF1A1A2E),
                    borderRadius: BorderRadius.circular(8),
                    border: Border.all(color: Colors.redAccent.withValues(alpha: 0.3)),
                  ),
                  child: SingleChildScrollView(
                    child: SelectableText(
                      '${details.exception}',
                      style: const TextStyle(
                        color: Colors.redAccent,
                        fontSize: 14,
                        fontFamily: 'monospace',
                      ),
                    ),
                  ),
                ),
              ),
              if (details.stack != null) ...[
                const SizedBox(height: 12),
                const Text(
                  'Stack trace:',
                  style: TextStyle(color: Colors.grey, fontSize: 13),
                ),
                const SizedBox(height: 4),
                Expanded(
                  flex: 3,
                  child: Container(
                    padding: const EdgeInsets.all(12),
                    decoration: BoxDecoration(
                      color: const Color(0xFF1A1A2E),
                      borderRadius: BorderRadius.circular(8),
                    ),
                    child: SingleChildScrollView(
                      child: SelectableText(
                        '${details.stack}',
                        style: const TextStyle(
                          color: Colors.grey,
                          fontSize: 12,
                          fontFamily: 'monospace',
                        ),
                      ),
                    ),
                  ),
                ),
              ],
              const SizedBox(height: 16),
              Center(
                child: Row(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    const Icon(Icons.info_outline, color: Colors.white54, size: 16),
                    const SizedBox(width: 8),
                    const Text(
                      'Выделите текст выше и нажмите Ctrl+C',
                      style: TextStyle(color: Colors.white54, fontSize: 13),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  };

  // Load environment variables from .env file (gracefully handle errors)
  try {
    await dotenv.load(fileName: '.env');
  } catch (e) {
    Logger().w('dotenv load failed: $e');
    debugPrint('⚠️ dotenv load failed: $e');
  }

  // Initialize SharedPreferences (gracefully handle errors)
  String savedLanguage = 'ru';
  try {
    final prefs = await SharedPreferences.getInstance();
    savedLanguage = prefs.getString(AppConstants.prefLanguage) ?? 'ru';
  } catch (e) {
    Logger().w('SharedPreferences init failed: $e');
    debugPrint('⚠️ SharedPreferences init failed: $e');
  }

  try {
    await Supabase.initialize(
      url: AppConstants.supabaseUrl,
      anonKey: AppConstants.supabaseAnonKey,
    );
    Logger().i('Supabase initialized successfully');
  } catch (e) {
    Logger().w('Supabase initialization failed: $e');
  }

  runApp(
    EasyLocalization(
      supportedLocales: const [
        Locale('tj'),
        Locale('ru'),
        Locale('en'),
        Locale('uz'),
        Locale('kk'),
        Locale('ky'),
        Locale('tk'),
      ],
      path: 'assets/translations',
      fallbackLocale: const Locale('ru'),
      startLocale: Locale(savedLanguage),
      child: const ProviderScope(
        child: OfarinApp(),
      ),
    ),
  );
}
