// ══════════════════════════════════════════════════════════════════════════════
// Parent Dashboard — Overview of family, tasks, and quick actions
// ══════════════════════════════════════════════════════════════════════════════

import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import '../../../../core/theme/app_colors.dart';

class ParentDashboard extends StatelessWidget {
  const ParentDashboard({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
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
        child: SafeArea(
          child: SingleChildScrollView(
            padding: const EdgeInsets.all(20),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                const SizedBox(height: 16),
                Text(
                  'parent_dashboard'.tr(),
                  style: const TextStyle(
                    fontSize: 24,
                    fontWeight: FontWeight.w700,
                    color: AppColors.textPrimary,
                  ),
                ),
                const SizedBox(height: 24),
                // Quick action grid
                _QuickActionCard(
                  icon: Icons.add_task,
                  label: 'create_task'.tr(),
                  onTap: () => context.go('/parent/create-task'),
                ),
                const SizedBox(height: 12),
                _QuickActionCard(
                  icon: Icons.checklist,
                  label: '${'approve_tasks'.tr()} (3)',
                  onTap: () => context.go('/parent/approve-tasks'),
                ),
                const SizedBox(height: 12),
                _QuickActionCard(
                  icon: Icons.account_balance,
                  label: 'economy'.tr(),
                  onTap: () => context.go('/parent/economy'),
                ),
                const SizedBox(height: 12),
                _QuickActionCard(
                  icon: Icons.favorite,
                  label: 'wishlist'.tr(),
                  onTap: () => context.go('/parent/wishlist-approval'),
                ),
                const SizedBox(height: 12),
                _QuickActionCard(
                  icon: Icons.person_add,
                  label: 'add_child'.tr(),
                  onTap: () => context.go('/parent/add-child'),
                ),
                const SizedBox(height: 12),
                _QuickActionCard(
                  icon: Icons.bar_chart,
                  label: 'statistics'.tr(),
                  onTap: () => context.go('/parent/statistics'),
                ),
                const SizedBox(height: 12),
                _QuickActionCard(
                  icon: Icons.settings,
                  label: 'settings'.tr(),
                  onTap: () => context.go('/parent/settings'),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

class _QuickActionCard extends StatelessWidget {
  final IconData icon;
  final String label;
  final VoidCallback onTap;

  const _QuickActionCard({
    required this.icon,
    required this.label,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return Material(
      color: AppColors.surfaceDark,
      borderRadius: BorderRadius.circular(16),
      child: InkWell(
        borderRadius: BorderRadius.circular(16),
        onTap: onTap,
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 20),
          child: Row(
            children: [
              Icon(icon, color: AppColors.primary, size: 28),
              const SizedBox(width: 16),
              Text(
                label,
                style: const TextStyle(
                  fontSize: 16,
                  fontWeight: FontWeight.w600,
                  color: AppColors.textPrimary,
                ),
              ),
              const Spacer(),
              const Icon(Icons.chevron_right, color: AppColors.textSecondary),
            ],
          ),
        ),
      ),
    );
  }
}
