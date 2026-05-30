// ══════════════════════════════════════════════════════════════════════════════
// Language Picker Screen — First interactive screen, 7 languages with flags
// ══════════════════════════════════════════════════════════════════════════════

import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../../../../core/constants/app_constants.dart';
import '../../../../core/theme/app_colors.dart';

class LanguagePickerScreen extends StatefulWidget {
  const LanguagePickerScreen({super.key});

  @override
  State<LanguagePickerScreen> createState() => _LanguagePickerScreenState();
}

class _LanguagePickerScreenState extends State<LanguagePickerScreen> {
  final List<_LanguageInfo> _languages = [
    _LanguageInfo(
      locale: const Locale('tj'),
      name: 'Тоҷикӣ',
      appName: 'Офарин! Ту метавонӣ!',
      flag: '🇹🇯',
    ),
    _LanguageInfo(
      locale: const Locale('ru'),
      name: 'Русский',
      appName: 'Молодец! Ты сможешь!',
      flag: '🇷🇺',
    ),
    _LanguageInfo(
      locale: const Locale('en'),
      name: 'English',
      appName: 'Well Done! You Can Do It!',
      flag: '🇬🇧',
    ),
    _LanguageInfo(
      locale: const Locale('uz'),
      name: "O'zbek",
      appName: 'Barakalla! Sen uddalaysan!',
      flag: '🇺🇿',
    ),
    _LanguageInfo(
      locale: const Locale('kk'),
      name: 'Қазақ',
      appName: 'Жарайсың! Қолыңнан келеді!',
      flag: '🇰🇿',
    ),
    _LanguageInfo(
      locale: const Locale('ky'),
      name: 'Кыргыз',
      appName: 'Азамат! Колуңдан келет!',
      flag: '🇰🇬',
    ),
    _LanguageInfo(
      locale: const Locale('tk'),
      name: 'Türkmen',
      appName: 'Berekella! Başararsyň!',
      flag: '🇹🇲',
    ),
  ];

  Future<void> _selectLanguage(Locale locale) async {
    // Save locale preference first (before setLocale triggers a rebuild)
    final prefs = await SharedPreferences.getInstance();
    await prefs.setString(AppConstants.prefLanguage, locale.languageCode);

    // Apply the locale change (this triggers a widget tree rebuild)
    await context.setLocale(locale);

    if (!mounted) return;

    // Defer navigation to after the current frame so the locale change
    // is fully processed before we navigate away
    WidgetsBinding.instance.addPostFrameCallback((_) {
      if (!mounted) return;
      context.go('/login');
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        width: double.infinity,
        height: double.infinity,
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
            colors: [
              AppColors.backgroundDark,
              Color(0xFF1A1A3E),
              AppColors.backgroundDark,
            ],
          ),
        ),
        child: SafeArea(
          child: Column(
            children: [
              const SizedBox(height: 40),
              // Header
              Icon(
                Icons.language,
                size: 48,
                color: AppColors.primary.withValues(alpha: 0.9),
              ),
              const SizedBox(height: 16),
              Text(
                'select_language'.tr(),
                style: const TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.w700,
                  color: AppColors.textPrimary,
                ),
                textAlign: TextAlign.center,
              ),
              const SizedBox(height: 8),
              Text(
                'language_settings_note'.tr(),
                style: const TextStyle(
                  fontSize: 14,
                  color: AppColors.textSecondary,
                ),
                textAlign: TextAlign.center,
              ),
              const SizedBox(height: 32),
              // Language list
              Expanded(
                child: ListView.separated(
                  padding: const EdgeInsets.symmetric(horizontal: 20),
                  itemCount: _languages.length,
                  separatorBuilder: (_, __) => const SizedBox(height: 12),
                  itemBuilder: (context, index) {
                    final lang = _languages[index];
                    final isSelected =
                        context.locale.languageCode == lang.locale.languageCode;

                    return _LanguageCard(
                      language: lang,
                      isSelected: isSelected,
                      onTap: () => _selectLanguage(lang.locale),
                    );
                  },
                ),
              ),
              const SizedBox(height: 20),
            ],
          ),
        ),
      ),
    );
  }
}

class _LanguageInfo {
  final Locale locale;
  final String name;
  final String appName;
  final String flag;

  const _LanguageInfo({
    required this.locale,
    required this.name,
    required this.appName,
    required this.flag,
  });
}

class _LanguageCard extends StatelessWidget {
  final _LanguageInfo language;
  final bool isSelected;
  final VoidCallback onTap;

  const _LanguageCard({
    required this.language,
    required this.isSelected,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return Material(
      color: isSelected
          ? AppColors.primary.withValues(alpha: 0.15)
          : AppColors.surfaceDark,
      borderRadius: BorderRadius.circular(16),
      child: InkWell(
        borderRadius: BorderRadius.circular(16),
        onTap: onTap,
        child: Container(
          padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 16),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(16),
            border: isSelected
                ? Border.all(color: AppColors.primary, width: 2)
                : null,
          ),
          child: Row(
            children: [
              // Flag
              Text(language.flag, style: const TextStyle(fontSize: 36)),
              const SizedBox(width: 16),
              // Info
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      language.name,
                      style: const TextStyle(
                        fontSize: 18,
                        fontWeight: FontWeight.w600,
                        color: AppColors.textPrimary,
                      ),
                    ),
                    const SizedBox(height: 4),
                    Text(
                      language.appName,
                      style: TextStyle(
                        fontSize: 13,
                        color: isSelected
                            ? AppColors.primary
                            : AppColors.textSecondary,
                        fontStyle: FontStyle.italic,
                      ),
                    ),
                  ],
                ),
              ),
              if (isSelected)
                const Icon(Icons.check_circle, color: AppColors.primary, size: 28),
            ],
          ),
        ),
      ),
    );
  }
}
