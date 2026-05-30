// ══════════════════════════════════════════════════════════════════════════════
// Офарин! Ту метавонӣ! — App Widget & Router
// ══════════════════════════════════════════════════════════════════════════════

import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:flutter_localizations/flutter_localizations.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';

import 'core/theme/app_theme.dart';
import 'features/settings/presentation/providers/theme_provider.dart';
import 'core/router/app_router.dart';

class OfarinApp extends ConsumerWidget {
  const OfarinApp({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final router = ref.watch(appRouterProvider);
    final themeMode = ref.watch(themeModeProvider);

    return ScreenUtilInit(
      designSize: const Size(390, 844), // iPhone 14 Pro base
      minTextAdapt: true,
      splitScreenMode: true,
      builder: (context, child) {
        // Wrap in SelectionArea so all text is selectable/copyable
        // even with CanvasKit renderer (Flutter 3.44+)
        return SelectionArea(
          child: MaterialApp.router(
            title: 'app_name'.tr(),
            debugShowCheckedModeBanner: false,
            theme: AppTheme.lightTheme,
            darkTheme: AppTheme.darkTheme,
            themeMode: themeMode,
            routerConfig: router,
            localizationsDelegates: context.localizationDelegates,
            supportedLocales: context.supportedLocales,
            locale: context.locale,
          ),
        );
      },
    );
  }
}
