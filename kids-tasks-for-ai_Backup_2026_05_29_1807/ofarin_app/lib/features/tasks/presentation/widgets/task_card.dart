// ══════════════════════════════════════════════════════════════════════════════
// Task Card — Reusable card for displaying tasks in lists
// ══════════════════════════════════════════════════════════════════════════════

import 'package:flutter/material.dart';
import '../../../../core/theme/app_colors.dart';
import '../../data/enums/task_status.dart';

class TaskCard extends StatelessWidget {
  final String title;
  final String description;
  final String rewardAmount;
  final String rewardCurrency;
  final TaskStatus status;
  final VoidCallback? onTap;
  final VoidCallback? onStartTimer;

  const TaskCard({
    super.key,
    required this.title,
    required this.description,
    required this.rewardAmount,
    required this.rewardCurrency,
    this.status = TaskStatus.active,
    this.onTap,
    this.onStartTimer,
  });

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: Material(
        color: status == TaskStatus.completed
            ? AppColors.success.withValues(alpha: 0.1)
            : AppColors.surfaceDark,
        borderRadius: BorderRadius.circular(16),
        child: InkWell(
          borderRadius: BorderRadius.circular(16),
          onTap: onTap,
          child: Container(
            padding: const EdgeInsets.all(16),
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(16),
              border: status == TaskStatus.pendingApproval
                  ? Border.all(color: AppColors.warning.withValues(alpha: 0.5), width: 1)
                  : null,
            ),
            child: Row(
              children: [
                // Task icon
                Container(
                  width: 48,
                  height: 48,
                  decoration: BoxDecoration(
                    color: _getStatusColor().withValues(alpha: 0.15),
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Icon(_getIcon(), color: _getStatusColor(), size: 24),
                ),
                const SizedBox(width: 12),
                // Content
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        title,
                        style: const TextStyle(
                          fontSize: 16,
                          fontWeight: FontWeight.w600,
                          color: AppColors.textPrimary,
                        ),
                      ),
                      const SizedBox(height: 4),
                      Text(
                        description,
                        maxLines: 1,
                        overflow: TextOverflow.ellipsis,
                        style: const TextStyle(
                          fontSize: 13,
                          color: AppColors.textSecondary,
                        ),
                      ),
                      const SizedBox(height: 4),
                      Text(
                        '$rewardAmount $rewardCurrency',
                        style: const TextStyle(
                          fontSize: 14,
                          fontWeight: FontWeight.w600,
                          color: AppColors.primary,
                        ),
                      ),
                    ],
                  ),
                ),
                // Action button
                if (onStartTimer != null)
                  GestureDetector(
                    onTap: onStartTimer,
                    child: Container(
                      padding: const EdgeInsets.all(8),
                      decoration: BoxDecoration(
                        color: AppColors.accent.withValues(alpha: 0.15),
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: const Icon(Icons.play_arrow, color: AppColors.accent, size: 28),
                    ),
                  ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Color _getStatusColor() {
    switch (status) {
      case TaskStatus.active:
        return AppColors.primary;
      case TaskStatus.pendingApproval:
        return AppColors.warning;
      case TaskStatus.completed:
        return AppColors.success;
      case TaskStatus.rejected:
        return AppColors.error;
    }
  }

  IconData _getIcon() {
    switch (status) {
      case TaskStatus.active:
        return Icons.pending_outlined;
      case TaskStatus.pendingApproval:
        return Icons.hourglass_empty;
      case TaskStatus.completed:
        return Icons.check_circle_outline;
      case TaskStatus.rejected:
        return Icons.cancel_outlined;
    }
  }
}
