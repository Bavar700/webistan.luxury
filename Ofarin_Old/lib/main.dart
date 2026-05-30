import 'dart:ui';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:supabase_flutter/supabase_flutter.dart';
import 'app.dart';

void main() async {
  // Ensure Flutter engine bindings are initialized
  WidgetsFlutterBinding.ensureInitialized();

  // Set up detailed console error logging for Flutter framework errors
  FlutterError.onError = (FlutterErrorDetails details) {
    FlutterError.presentError(details);
    debugPrint('--- CRITICAL FLUTTER FRAMEWORK ERROR ---');
    debugPrint(details.exceptionAsString());
    debugPrint(details.stack?.toString());
    debugPrint('---------------------------------------');
  };

  // Set up platform-channel / async error logging
  PlatformDispatcher.instance.onError = (Object error, StackTrace stack) {
    debugPrint('--- CRITICAL ASYNC/PLATFORM ERROR ---');
    debugPrint(error.toString());
    debugPrint(stack.toString());
    debugPrint('------------------------------------');
    return true;
  };

  // Supabase initialization
  try {
    const String supabaseUrl = String.fromEnvironment('SUPABASE_URL', defaultValue: '');
    const String supabaseAnonKey = String.fromEnvironment('SUPABASE_ANON_KEY', defaultValue: '');

    if (supabaseUrl.isNotEmpty && supabaseAnonKey.isNotEmpty) {
      await Supabase.initialize(
        url: supabaseUrl,
        anonKey: supabaseAnonKey,
      );
    }
  } catch (e, stack) {
    debugPrint('Supabase initialization failed: $e');
    debugPrint(stack.toString());
  }

  runApp(
    const ProviderScope(
      child: OfarinApp(),
    ),
  );
}
