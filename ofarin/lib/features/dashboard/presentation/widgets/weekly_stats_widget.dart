import 'package:flutter/material.dart';
import '../../../../core/widgets/glassmorphic_card.dart';

class WeeklyStatsWidget extends StatelessWidget {
  final int tasksCompleted;
  final int totalXpEarned;
  final int activeTasks;

  const WeeklyStatsWidget({
    super.key,
    required this.tasksCompleted,
    required this.totalXpEarned,
    required this.activeTasks,
  });

  @override
  Widget build(BuildContext context) {
    return GlassmorphicCard(
      opacity: 0.1,
      padding: const EdgeInsets.all(20),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text(
            'Омори ҳафта 📊',
            style: TextStyle(
              color: Colors.white,
              fontSize: 18,
              fontWeight: FontWeight.bold,
            ),
          ),
          const SizedBox(height: 16),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              _StatItem(
                title: 'Иҷрошуда',
                value: tasksCompleted.toString(),
                icon: '✅',
                color: Colors.green,
              ),
              _StatItem(
                title: 'XP гирифташуд',
                value: '+$totalXpEarned',
                icon: '⭐',
                color: const Color(0xFF4FC3F7),
              ),
              _StatItem(
                title: 'Фаъол',
                value: activeTasks.toString(),
                icon: '🔥',
                color: Colors.orange,
              ),
            ],
          ),
        ],
      ),
    );
  }
}

class _StatItem extends StatelessWidget {
  final String title;
  final String value;
  final String icon;
  final Color color;

  const _StatItem({
    required this.title,
    required this.value,
    required this.icon,
    required this.color,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Container(
          padding: const EdgeInsets.all(12),
          decoration: BoxDecoration(
            color: color.withOpacity(0.2),
            shape: BoxShape.circle,
          ),
          child: Text(icon, style: const TextStyle(fontSize: 20)),
        ),
        const SizedBox(height: 8),
        Text(
          value,
          style: TextStyle(
            color: color,
            fontSize: 20,
            fontWeight: FontWeight.bold,
          ),
        ),
        const SizedBox(height: 4),
        Text(
          title,
          style: TextStyle(
            color: Colors.white.withOpacity(0.7),
            fontSize: 12,
          ),
        ),
      ],
    );
  }
}
