// ══════════════════════════════════════════════════════════════════════════════
// Parent Settings Screen — App settings, family, and preferences
// ══════════════════════════════════════════════════════════════════════════════

import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../../../../core/theme/app_colors.dart';
import '../../../settings/presentation/providers/theme_provider.dart';

class ParentSettingsScreen extends ConsumerWidget {
  const ParentSettingsScreen({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final themeMode = ref.watch(themeModeProvider);

    return Scaffold(
      appBar: AppBar(
        title: const Text('Настройки'),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () => context.pop(),
        ),
      ),
      body: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
            colors: [
              AppColors.backgroundDark,
              Color(0xFF1A1A3E),
            ],
          ),
        ),
        child: ListView(
          padding: const EdgeInsets.all(20),
          children: [
            // Theme toggle
            _SettingsTile(
              icon: Icons.dark_mode,
              title: 'Тёмная тема',
              trailing: Switch(
                value: themeMode == ThemeMode.dark,
                activeColor: AppColors.primary,
                onChanged: (val) {
                  ref.read(themeModeProvider.notifier).toggle();
                },
              ),
            ),
            const SizedBox(height: 12),
            // Language
            _SettingsTile(
              icon: Icons.language,
              title: 'Язык: ${context.locale.languageCode.toUpperCase()}',
              onTap: () => context.go('/language-picker'),
            ),
            const SizedBox(height: 12),
            // About
            _SettingsTile(
              icon: Icons.info_outline,
              title: 'О приложении',
              trailing: const Text(
                'v1.0.0',
                style: TextStyle(color: AppColors.textSecondary),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class _SettingsTile extends StatelessWidget {
  final IconData icon;
  final String title;
  final Widget? trailing;
  final VoidCallback? onTap;

  const _SettingsTile({
    required this.icon,
    required this.title,
    this.trailing,
    this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return Material(
      color: AppColors.surfaceDark,
      borderRadius: BorderRadius.circular(12),
      child: InkWell(
        borderRadius: BorderRadius.circular(12),
        onTap: onTap,
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 16),
          child: Row(
            children: [
              Icon(icon, color: AppColors.primary, size: 24),
              const SizedBox(width: 16),
              Expanded(
                child: Text(title, style: const TextStyle(fontSize: 16, color: AppColors.textPrimary)),
              ),
              if (trailing != null) trailing!,
              if (onTap != null)
                const Icon(Icons.chevron_right, color: AppColors.textSecondary),
            ],
          ),
        ),
      ),
    );
  }
}
