import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:ofarin/l10n/app_localizations.dart';
import '../../../app.dart';
import '../../../constants/app_colors.dart';
import '../../../routing/route_constants.dart';
import '../data/auth_repository.dart';
import '../domain/auth_state.dart';

class ModeSelectionScreen extends ConsumerWidget {
  const ModeSelectionScreen({super.key});

  void _showChildSelectionSheet(
      BuildContext context, WidgetRef ref, UserProfile parent) {
    final authRepo = ref.read(authRepositoryProvider);
    final localizations = AppLocalizations.of(context);

    showModalBottomSheet(
      context: context,
      backgroundColor: Colors.transparent,
      isScrollControlled: true,
      builder: (ctx) {
        return Container(
          decoration: const BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.vertical(top: Radius.circular(32)),
          ),
          padding: const EdgeInsets.all(24),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              // Drag handle
              Container(
                width: 48,
                height: 5,
                decoration: BoxDecoration(
                  color: AppColors.borderLight,
                  borderRadius: BorderRadius.circular(10),
                ),
              ),
              const SizedBox(height: 20),
              Text(
                localizations?.selectChild ?? '👦 Интихоби Кӯдак',
                style: const TextStyle(
                  fontSize: 22,
                  fontWeight: FontWeight.bold,
                  color: AppColors.textPrimaryLight,
                ),
              ),
              const SizedBox(height: 20),
              FutureBuilder<List<UserProfile>>(
                future: authRepo.fetchChildren(parent.id),
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return const Padding(
                      padding: EdgeInsets.all(32),
                      child: CircularProgressIndicator(color: AppColors.primary),
                    );
                  }

                  final children = snapshot.data ?? [];
                  if (children.isEmpty) {
                    return Column(
                      children: [
                        const Text('👶', style: TextStyle(fontSize: 56)),
                        const SizedBox(height: 12),
                        Text(
                          localizations?.noChildrenAdded ?? 'Ҳанӯз кӯдаке илова нашудааст.\nАввал дар реҷаи волидайн кӯдак илова кунед.',
                          textAlign: TextAlign.center,
                          style: const TextStyle(
                            color: AppColors.textSecondaryLight,
                            fontSize: 15,
                          ),
                        ),
                        const SizedBox(height: 16),
                        _FunButton(
                          label: 'Реҷаи Волидайн',
                          gradient: AppColors.primaryGradient,
                          onTap: () {
                            Navigator.pop(ctx);
                            context.go(RoutePaths.parentDashboard);
                          },
                        ),
                      ],
                    );
                  }

                  return Column(
                    children: children.map((child) {
                      return Padding(
                        padding: const EdgeInsets.only(bottom: 12),
                        child: GestureDetector(
                          onTap: () {
                            ref.read(appModeProvider.notifier).setActiveChild(child);
                            Navigator.pop(ctx);
                            context.go(RoutePaths.childDashboard);
                          },
                          child: Container(
                            padding: const EdgeInsets.all(16),
                            decoration: BoxDecoration(
                              gradient: AppColors.childBgGradient,
                              borderRadius: BorderRadius.circular(20),
                              border: Border.all(color: AppColors.primaryLight.withOpacity(0.3)),
                            ),
                            child: Row(
                              children: [
                                Container(
                                  width: 56,
                                  height: 56,
                                  decoration: BoxDecoration(
                                    gradient: AppColors.accentGradient,
                                    shape: BoxShape.circle,
                                  ),
                                  child: Center(
                                    child: Text(
                                      child.avatarUrl ?? '🦊',
                                      style: const TextStyle(fontSize: 28),
                                    ),
                                  ),
                                ),
                                const SizedBox(width: 16),
                                Expanded(
                                  child: Column(
                                    crossAxisAlignment: CrossAxisAlignment.start,
                                    children: [
                                      Text(
                                        child.displayName,
                                        style: const TextStyle(
                                          fontSize: 18,
                                          fontWeight: FontWeight.bold,
                                          color: AppColors.textPrimaryLight,
                                        ),
                                      ),
                                      const SizedBox(height: 4),
                                      Row(
                                        children: [
                                          const Text('⭐ '),
                                          Text('${child.starsBalance}',
                                              style: const TextStyle(
                                                  fontWeight: FontWeight.bold,
                                                  color: AppColors.accentDark)),
                                          const SizedBox(width: 12),
                                          const Text('🔥 '),
                                          Text('${child.streakCount} рӯз',
                                              style: const TextStyle(
                                                  fontWeight: FontWeight.bold,
                                                  color: AppColors.funOrange)),
                                        ],
                                      ),
                                    ],
                                  ),
                                ),
                                const Icon(Icons.arrow_forward_ios_rounded,
                                    size: 16, color: AppColors.primary),
                              ],
                            ),
                          ),
                        ),
                      );
                    }).toList(),
                  );
                },
              ),
              const SizedBox(height: 16),
            ],
          ),
        );
      },
    );
  }

  void _showLanguageSheet(BuildContext context, WidgetRef ref) {
    final langs = [
      {'code': 'tg', 'label': '🇹🇯 Тоҷикӣ'},
      {'code': 'ru', 'label': '🇷🇺 Русский'},
      {'code': 'en', 'label': '🇬🇧 English'},
      {'code': 'uz', 'label': '🇺🇿 O\'zbek'},
      {'code': 'kk', 'label': '🇰🇿 Қазақша'},
      {'code': 'ky', 'label': '🇰🇬 Кыргызча'},
      {'code': 'tk', 'label': '🇹🇲 Türkmen'},
    ];

    showModalBottomSheet(
      context: context,
      backgroundColor: Colors.transparent,
      isScrollControlled: true,
      builder: (ctx) {
        final localizations = AppLocalizations.of(context);
        return Container(
          decoration: const BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.vertical(top: Radius.circular(32)),
          ),
          padding: const EdgeInsets.all(24),
          child: SingleChildScrollView(
            child: Column(
              mainAxisSize: MainAxisSize.min,
              children: [
              Container(
                width: 48,
                height: 5,
                decoration: BoxDecoration(
                  color: AppColors.borderLight,
                  borderRadius: BorderRadius.circular(10),
                ),
              ),
              const SizedBox(height: 20),
              Text(localizations?.selectLanguage ?? '🌍 Интихоби Забон',
                  style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold)),
              const SizedBox(height: 16),
              ...langs.map((lang) {
                final currentLocale = ref.read(localeProvider);
                final isSelected = currentLocale.languageCode == lang['code'];
                return GestureDetector(
                  onTap: () {
                    ref.read(localeProvider.notifier).state =
                        Locale(lang['code']!);
                    Navigator.pop(ctx);
                  },
                  child: Container(
                    margin: const EdgeInsets.only(bottom: 8),
                    padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 14),
                    decoration: BoxDecoration(
                      color: isSelected
                          ? AppColors.primary.withOpacity(0.1)
                          : AppColors.bgLight,
                      borderRadius: BorderRadius.circular(14),
                      border: Border.all(
                        color: isSelected ? AppColors.primary : Colors.transparent,
                        width: 2,
                      ),
                    ),
                    child: Row(
                      children: [
                        Text(lang['label']!,
                            style: TextStyle(
                              fontSize: 16,
                              fontWeight: isSelected
                                  ? FontWeight.bold
                                  : FontWeight.normal,
                              color: isSelected
                                  ? AppColors.primary
                                  : AppColors.textPrimaryLight,
                            )),
                        const Spacer(),
                        if (isSelected)
                          const Icon(Icons.check_circle_rounded,
                              color: AppColors.primary),
                      ],
                    ),
                  ),
                );
              }),
              const SizedBox(height: 16),
            ],
          ),
          ),
        );
      },
    );
  }

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final authState = ref.watch(authStateProvider);

    if (authState is! AuthAuthenticated) {
      return const Scaffold(
        body: Center(child: CircularProgressIndicator()),
      );
    }

    final parentProfile = authState.profile;
    final localizations = AppLocalizations.of(context);
    final String txtParent = localizations?.parentMode ?? 'Реҷаи Волидайн';
    final String txtChild = localizations?.childMode ?? 'Реҷаи Кӯдак';

    return Scaffold(
      body: Container(
        decoration: const BoxDecoration(
          gradient: AppColors.childBgGradient,
        ),
        child: SafeArea(
          child: Column(
            children: [
              // Top bar
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
                child: Row(
                  children: [
                    // User greeting
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            localizations?.welcomeTitle ?? 'Хуш омадед! 👋',
                            style: const TextStyle(
                              fontSize: 13,
                              color: AppColors.textSecondaryLight,
                            ),
                          ),
                          Text(
                            parentProfile.displayName,
                            style: const TextStyle(
                              fontSize: 18,
                              fontWeight: FontWeight.bold,
                              color: AppColors.textPrimaryLight,
                            ),
                          ),
                        ],
                      ),
                    ),
                    // Language button
                    GestureDetector(
                      onTap: () => _showLanguageSheet(context, ref),
                      child: Container(
                        padding: const EdgeInsets.symmetric(
                            horizontal: 14, vertical: 8),
                        decoration: BoxDecoration(
                          color: AppColors.primary.withOpacity(0.1),
                          borderRadius: BorderRadius.circular(20),
                        ),
                        child: Row(
                          children: [
                            const Text('🌍', style: TextStyle(fontSize: 16)),
                            const SizedBox(width: 6),
                            Text(
                              localizations?.language ?? 'Забон',
                              style: TextStyle(
                                color: AppColors.primary,
                                fontWeight: FontWeight.bold,
                                fontSize: 13,
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                    const SizedBox(width: 8),
                    // Logout button
                    GestureDetector(
                      onTap: () {
                        ref.read(authStateProvider.notifier).signOut();
                        context.go(RoutePaths.auth);
                      },
                      child: Container(
                        padding: const EdgeInsets.all(10),
                        decoration: BoxDecoration(
                          color: AppColors.error.withOpacity(0.1),
                          shape: BoxShape.circle,
                        ),
                        child: const Icon(Icons.logout_rounded,
                            color: AppColors.error, size: 20),
                      ),
                    ),
                  ],
                ),
              ),

              Expanded(
                child: Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 24),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      // Big decorative emoji
                      const Text('🎯', style: TextStyle(fontSize: 72)),
                      const SizedBox(height: 8),
                      Text(
                        localizations?.whoIsEntering ?? 'Кӣ ворид мешавад?',
                        style: const TextStyle(
                          fontSize: 26,
                          fontWeight: FontWeight.w900,
                          color: AppColors.textPrimaryLight,
                        ),
                      ),
                      const SizedBox(height: 40),

                      // Parent Card
                      _ModeCard(
                        emoji: '👨‍👩‍👧',
                        title: txtParent,
                        subtitle: localizations?.parentModeDesc ?? 'Назорат, вазифаҳо, мукофот ва танзим',
                        gradient: AppColors.primaryGradient,
                        badge: '🔐 PIN',
                        onTap: () {
                          ref
                              .read(appModeProvider.notifier)
                              .setMode(AppMode.parent);
                          context.go(RoutePaths.parentDashboard);
                        },
                      ),
                      const SizedBox(height: 20),

                      // Child Card
                      _ModeCard(
                        emoji: '🦊',
                        title: txtChild,
                        subtitle: localizations?.childModeDesc ?? 'Вазифаҳо, ситораҳо ва орзуҳо!',
                        gradient: AppColors.accentGradient,
                        badge: '🎮',
                        onTap: () =>
                            _showChildSelectionSheet(context, ref, parentProfile),
                      ),
                    ],
                  ),
                ),
              ),

              // Bottom credit
              Padding(
                padding: const EdgeInsets.only(bottom: 20),
                child: Text(
                  '© Офарин! 2024',
                  style: TextStyle(
                      color: AppColors.textSecondaryLight, fontSize: 12),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class _ModeCard extends StatefulWidget {
  final String emoji;
  final String title;
  final String subtitle;
  final Gradient gradient;
  final String badge;
  final VoidCallback onTap;

  const _ModeCard({
    required this.emoji,
    required this.title,
    required this.subtitle,
    required this.gradient,
    required this.badge,
    required this.onTap,
  });

  @override
  State<_ModeCard> createState() => _ModeCardState();
}

class _ModeCardState extends State<_ModeCard> {
  bool _pressed = false;

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTapDown: (_) => setState(() => _pressed = true),
      onTapUp: (_) {
        setState(() => _pressed = false);
        widget.onTap();
      },
      onTapCancel: () => setState(() => _pressed = false),
      child: AnimatedScale(
        scale: _pressed ? 0.96 : 1.0,
        duration: const Duration(milliseconds: 120),
        child: Container(
          padding: const EdgeInsets.all(24),
          decoration: BoxDecoration(
            gradient: widget.gradient,
            borderRadius: BorderRadius.circular(28),
            boxShadow: [
              BoxShadow(
                color: Colors.black.withOpacity(0.15),
                blurRadius: 20,
                offset: const Offset(0, 8),
              ),
            ],
          ),
          child: Row(
            children: [
              // Emoji container
              Container(
                width: 72,
                height: 72,
                decoration: BoxDecoration(
                  color: Colors.white.withOpacity(0.25),
                  shape: BoxShape.circle,
                ),
                child: Center(
                  child: Text(widget.emoji,
                      style: const TextStyle(fontSize: 36)),
                ),
              ),
              const SizedBox(width: 20),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Row(
                      children: [
                        Text(
                          widget.title,
                          style: const TextStyle(
                            fontSize: 20,
                            fontWeight: FontWeight.bold,
                            color: Colors.white,
                          ),
                        ),
                        const Spacer(),
                        Container(
                          padding: const EdgeInsets.symmetric(
                              horizontal: 10, vertical: 4),
                          decoration: BoxDecoration(
                            color: Colors.white.withOpacity(0.25),
                            borderRadius: BorderRadius.circular(12),
                          ),
                          child: Text(
                            widget.badge,
                            style: const TextStyle(
                                color: Colors.white,
                                fontSize: 12,
                                fontWeight: FontWeight.bold),
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 6),
                    Text(
                      widget.subtitle,
                      style: TextStyle(
                        fontSize: 13,
                        color: Colors.white.withOpacity(0.85),
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class _FunButton extends StatelessWidget {
  final String label;
  final Gradient gradient;
  final VoidCallback onTap;

  const _FunButton({
    required this.label,
    required this.gradient,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: onTap,
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 32, vertical: 14),
        decoration: BoxDecoration(
          gradient: gradient,
          borderRadius: BorderRadius.circular(16),
        ),
        child: Text(
          label,
          style: const TextStyle(
              color: Colors.white, fontWeight: FontWeight.bold, fontSize: 16),
        ),
      ),
    );
  }
}
