// ══════════════════════════════════════════════════════════════════════════════
// Statistics Screen — Shows task completion and economy statistics
// ══════════════════════════════════════════════════════════════════════════════

import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import '../../../../core/theme/app_colors.dart';

class StatisticsScreen extends StatelessWidget {
  const StatisticsScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Статистика'),
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
            // Summary cards
            Row(
              children: [
                Expanded(child: _StatCard(icon: Icons.check_circle, label: 'Выполнено', value: '12', color: AppColors.success)),
                const SizedBox(width: 12),
                Expanded(child: _StatCard(icon: Icons.pending, label: 'Активно', value: '5', color: AppColors.warning)),
              ],
            ),
            const SizedBox(height: 12),
            Row(
              children: [
                Expanded(child: _StatCard(icon: Icons.star, label: 'Звёзд получено', value: '45 ⭐', color: AppColors.starCurrency)),
                const SizedBox(width: 12),
                Expanded(child: _StatCard(icon: Icons.emoji_events, label: 'Золота', value: '8 🏆', color: AppColors.goldCurrency)),
              ],
            ),
            const SizedBox(height: 24),
            const Text(
              'Последние 7 дней',
              style: TextStyle(
                fontSize: 18,
                fontWeight: FontWeight.w700,
                color: AppColors.textPrimary,
              ),
            ),
            const SizedBox(height: 12),
            // Simple progress bars for days
            _DayBar(day: 'Пн', completed: 3, total: 4),
            _DayBar(day: 'Вт', completed: 2, total: 3),
            _DayBar(day: 'Ср', completed: 4, total: 4),
            _DayBar(day: 'Чт', completed: 1, total: 3),
            _DayBar(day: 'Пт', completed: 3, total: 5),
            _DayBar(day: 'Сб', completed: 2, total: 2),
            _DayBar(day: 'Вс', completed: 0, total: 1),
          ],
        ),
      ),
    );
  }
}

class _StatCard extends StatelessWidget {
  final IconData icon;
  final String label;
  final String value;
  final Color color;

  const _StatCard({required this.icon, required this.label, required this.value, required this.color});

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: AppColors.surfaceDark,
        borderRadius: BorderRadius.circular(16),
      ),
      child: Column(
        children: [
          Icon(icon, color: color, size: 28),
          const SizedBox(height: 8),
          Text(value, style: TextStyle(fontSize: 20, fontWeight: FontWeight.w800, color: color)),
          const SizedBox(height: 4),
          Text(label, style: const TextStyle(fontSize: 12, color: AppColors.textSecondary)),
        ],
      ),
    );
  }
}

class _DayBar extends StatelessWidget {
  final String day;
  final int completed;
  final int total;

  const _DayBar({required this.day, required this.completed, required this.total});

  @override
  Widget build(BuildContext context) {
    final progress = total > 0 ? completed / total : 0.0;
    return Padding(
      padding: const EdgeInsets.only(bottom: 8),
      child: Row(
        children: [
          SizedBox(
            width: 30,
            child: Text(day, style: const TextStyle(fontSize: 13, color: AppColors.textSecondary)),
          ),
          Expanded(
            child: ClipRRect(
              borderRadius: BorderRadius.circular(6),
              child: LinearProgressIndicator(
                value: progress,
                backgroundColor: AppColors.backgroundDark,
                valueColor: AlwaysStoppedAnimation<Color>(progress >= 1.0 ? AppColors.success : AppColors.primary),
                minHeight: 12,
              ),
            ),
          ),
          const SizedBox(width: 8),
          Text('$completed/$total', style: const TextStyle(fontSize: 13, color: AppColors.textSecondary)),
        ],
      ),
    );
  }
}
