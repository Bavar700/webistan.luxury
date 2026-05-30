import 'package:flutter/material.dart';
import '../../../../core/models/task_model.dart';
import '../../../../core/widgets/glassmorphic_card.dart';

class QuestCard extends StatelessWidget {
  final TaskModel task;
  final VoidCallback onTap;

  const QuestCard({
    super.key,
    required this.task,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    final bool isCompleted = task.status == 'completed';
    final bool isPending = task.status == 'pending_approval';

    return GestureDetector(
      onTap: isCompleted || isPending ? null : onTap,
      child: GlassmorphicCard(
        margin: const EdgeInsets.only(bottom: 16),
        opacity: isCompleted ? 0.05 : 0.15,
        borderColor: isPending ? Colors.orange : (isCompleted ? Colors.green : Colors.white),
        padding: const EdgeInsets.all(16),
        child: Row(
          children: [
            // Icon
            Container(
              width: 50,
              height: 50,
              decoration: BoxDecoration(
                color: task.statusColor.withOpacity(0.2),
                borderRadius: BorderRadius.circular(16),
                border: Border.all(color: task.statusColor.withOpacity(0.5)),
              ),
              child: Center(
                child: Text(
                  isCompleted ? '✅' : (isPending ? '⏳' : task.difficultyIcon),
                  style: const TextStyle(fontSize: 24),
                ),
              ),
            ),
            const SizedBox(width: 16),
            
            // Content
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    task.title,
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 16,
                      fontWeight: FontWeight.bold,
                      decoration: isCompleted ? TextDecoration.lineThrough : null,
                    ),
                  ),
                  if (task.description.isNotEmpty) ...[
                    const SizedBox(height: 4),
                    Text(
                      task.description,
                      style: TextStyle(
                        color: Colors.white.withOpacity(0.6),
                        fontSize: 12,
                      ),
                      maxLines: 1,
                      overflow: TextOverflow.ellipsis,
                    ),
                  ],
                  const SizedBox(height: 8),
                  // Rewards
                  Row(
                    children: [
                      _RewardBadge(icon: '⭐', amount: task.rewardXp.toString(), color: const Color(0xFF4FC3F7)),
                      const SizedBox(width: 8),
                      _RewardBadge(icon: '🪙', amount: task.rewardCoins.toString(), color: const Color(0xFFFFC107)),
                      if (task.rewardFiat > 0) ...[
                        const SizedBox(width: 8),
                        _RewardBadge(icon: '💵', amount: task.rewardFiat.toStringAsFixed(0), color: const Color(0xFF66BB6A)),
                      ],
                    ],
                  ),
                ],
              ),
            ),
            
            // Action button or Status
            if (!isCompleted && !isPending)
              Container(
                padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                decoration: BoxDecoration(
                  gradient: const LinearGradient(
                    colors: [Color(0xFFFFD700), Color(0xFFFFA000)],
                  ),
                  borderRadius: BorderRadius.circular(12),
                  boxShadow: [
                    BoxShadow(
                      color: const Color(0xFFFFD700).withOpacity(0.4),
                      blurRadius: 8,
                      spreadRadius: 1,
                    )
                  ],
                ),
                child: const Text(
                  'Иҷро',
                  style: TextStyle(
                    color: Colors.black,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
          ],
        ),
      ),
    );
  }
}

class _RewardBadge extends StatelessWidget {
  final String icon;
  final String amount;
  final Color color;

  const _RewardBadge({
    required this.icon,
    required this.amount,
    required this.color,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 6, vertical: 2),
      decoration: BoxDecoration(
        color: color.withOpacity(0.2),
        borderRadius: BorderRadius.circular(8),
        border: Border.all(color: color.withOpacity(0.5)),
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Text(icon, style: const TextStyle(fontSize: 12)),
          const SizedBox(width: 4),
          Text(
            amount,
            style: TextStyle(
              color: color,
              fontSize: 12,
              fontWeight: FontWeight.bold,
            ),
          ),
        ],
      ),
    );
  }
}
