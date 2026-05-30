import 'package:flutter/material.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter_localizations/flutter_localizations.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:ofarin/l10n/app_localizations.dart';
import 'constants/app_theme.dart';
import 'routing/app_router.dart';

// Provider for app locale (language switcher)
final localeProvider = StateProvider<Locale>((ref) => const Locale('tg'));

class OfarinApp extends ConsumerWidget {
  const OfarinApp({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final router = ref.watch(appRouterProvider);
    final locale = ref.watch(localeProvider);

    return MaterialApp.router(
      title: 'Офарин! Ту метавонӣ!',
      debugShowCheckedModeBanner: false,

      theme: AppTheme.lightTheme,
      darkTheme: AppTheme.darkTheme,
      themeMode: ThemeMode.light,  // Force light for vibrant children's UI

      routerConfig: router,

      locale: locale,
      localizationsDelegates: const [
        AppLocalizations.delegate,
        FallbackMaterialLocalizationsDelegate(),
        FallbackCupertinoLocalizationsDelegate(),
        GlobalMaterialLocalizations.delegate,
        GlobalWidgetsLocalizations.delegate,
        GlobalCupertinoLocalizations.delegate,
      ],
      supportedLocales: const [
        Locale('tg'), // Tajik (Default)
        Locale('ru'), // Russian
        Locale('en'), // English
        Locale('uz'), // Uzbek
        Locale('kk'), // Kazakh
        Locale('ky'), // Kyrgyz
        Locale('tk'), // Turkmen
      ],
    );
  }
}

class FallbackMaterialLocalizationsDelegate
    extends LocalizationsDelegate<MaterialLocalizations> {
  const FallbackMaterialLocalizationsDelegate();

  @override
  bool isSupported(Locale locale) => locale.languageCode == 'tg';

  @override
  Future<MaterialLocalizations> load(Locale locale) async {
    return GlobalMaterialLocalizations.delegate.load(const Locale('ru'));
  }

  @override
  bool shouldReload(FallbackMaterialLocalizationsDelegate old) => false;
}

class FallbackCupertinoLocalizationsDelegate
    extends LocalizationsDelegate<CupertinoLocalizations> {
  const FallbackCupertinoLocalizationsDelegate();

  @override
  bool isSupported(Locale locale) => locale.languageCode == 'tg';

  @override
  Future<CupertinoLocalizations> load(Locale locale) async {
    return GlobalCupertinoLocalizations.delegate.load(const Locale('ru'));
  }

  @override
  bool shouldReload(FallbackCupertinoLocalizationsDelegate old) => false;
}
