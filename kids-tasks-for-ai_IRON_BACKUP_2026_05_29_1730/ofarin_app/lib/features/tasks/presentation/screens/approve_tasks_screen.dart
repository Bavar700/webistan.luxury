// ══════════════════════════════════════════════════════════════════════════════
// Approve Tasks Screen — Parent reviews and approves/rejects completed tasks
// ══════════════════════════════════════════════════════════════════════════════

import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import '../../../../core/theme/app_colors.dart';
import '../../../../core/utils/snackbar_helper.dart';
import '../../data/models/task_model.dart';
import '../providers/task_provider.dart';
import '../../../auth/presentation/providers/auth_provider.dart';

class ApproveTasksScreen extends ConsumerStatefulWidget {
  const ApproveTasksScreen({super.key});

  @override
  ConsumerState<ApproveTasksScreen> createState() => _ApproveTasksScreenState();
}

class _ApproveTasksScreenState extends ConsumerState<ApproveTasksScreen> {
  @override
  void initState() {
    super.initState();
    _loadPendingTasks();
  }

  Future<void> _loadPendingTasks() async {
    final authState = ref.read(authProvider);
    final parentId = authState.user?.id;
    if (parentId != null) {
      ref.read(taskProvider.notifier).loadPendingTasks(parentId);
    }
  }

  Future<void> _handleApprove(String taskId) async {
    await ref.read(taskProvider.notifier).approveTask(taskId);
    if (mounted) {
      context.showSuccess('task_approved'.tr());
    }
  }

  Future<void> _handleReject(String taskId) async {
    // Show a dialog to get the rejection reason
    final reason = await showDialog<String>(
      context: context,
      builder: (ctx) => _RejectReasonDialog(),
    );
    if (reason != null && reason.isNotEmpty) {
      await ref.read(taskProvider.notifier).rejectTask(taskId, reason);
      if (mounted) {
        context.showSuccess('task_rejected'.tr());
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    final taskState = ref.watch(taskProvider);

    return Scaffold(
      appBar: AppBar(
        title: Text('approve_tasks_title'.tr()),
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
        child: taskState.isLoading
            ? const Center(child: CircularProgressIndicator())
            : taskState.tasks.isEmpty
                ? Center(
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        const Icon(
                          Icons.check_circle_outline,
                          size: 64,
                          color: AppColors.textSecondary,
                        ),
                        const SizedBox(height: 16),
                        Text(
                          'no_pending_tasks'.tr(),
                          style: const TextStyle(
                            fontSize: 16,
                            color: AppColors.textSecondary,
                          ),
                        ),
                        const SizedBox(height: 8),
                        Text(
                          'pending_tasks_description'.tr(),
                          style: const TextStyle(
                            fontSize: 13,
                            color: AppColors.textSecondary,
                          ),
                          textAlign: TextAlign.center,
                        ),
                      ],
                    ),
                  )
                : RefreshIndicator(
                    onRefresh: _loadPendingTasks,
                    color: AppColors.primary,
                    child: ListView(
                      padding: const EdgeInsets.all(20),
                      children: taskState.tasks.map((task) {
                        return Padding(
                          padding: const EdgeInsets.only(bottom: 12),
                          child: _TaskApprovalCard(
                            task: task,
                            onApprove: () => _handleApprove(task.id),
                            onReject: () => _handleReject(task.id),
                          ),
                        );
                      }).toList(),
                    ),
                  ),
      ),
    );
  }
}

class _TaskApprovalCard extends StatelessWidget {
  final TaskModel task;
  final VoidCallback onApprove;
  final VoidCallback onReject;

  const _TaskApprovalCard({
    required this.task,
    required this.onApprove,
    required this.onReject,
  });

  @override
  Widget build(BuildContext context) {
    final childInitial = task.childId.isNotEmpty ? task.childId[0].toUpperCase() : '?';
    final rewardStr = '${task.rewardAmount} ${task.rewardCurrency == 'star' ? '⭐' : task.rewardCurrency == 'gold' ? '🏆' : '💰'}';

    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: AppColors.surfaceDark,
        borderRadius: BorderRadius.circular(16),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              CircleAvatar(
                backgroundColor: AppColors.accent,
                child: Text(
                  childInitial,
                  style: const TextStyle(
                    color: Colors.white,
                    fontWeight: FontWeight.w700,
                  ),
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      task.title,
                      style: const TextStyle(
                        fontSize: 16,
                        fontWeight: FontWeight.w600,
                        color: AppColors.textPrimary,
                      ),
                    ),
                    if (task.description.isNotEmpty)
                      Text(
                        task.description,
                        style: const TextStyle(
                          fontSize: 13,
                          color: AppColors.textSecondary,
                        ),
                        maxLines: 2,
                        overflow: TextOverflow.ellipsis,
                      ),
                  ],
                ),
              ),
              // Proof image placeholder
              if (task.proofImageUrl != null && task.proofImageUrl!.isNotEmpty)
                Container(
                  width: 56,
                  height: 56,
                  decoration: BoxDecoration(
                    color: AppColors.backgroundDark,
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: const Icon(Icons.image, color: AppColors.textSecondary),
                )
              else
                Container(
                  width: 56,
                  height: 56,
                  decoration: BoxDecoration(
                    color: AppColors.backgroundDark,
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: const Icon(Icons.image_outlined, color: AppColors.textSecondary),
                ),
            ],
          ),
          const SizedBox(height: 12),
          Text(
            '${'reward'.tr()}: $rewardStr',
            style: const TextStyle(
              fontSize: 14,
              color: AppColors.primary,
              fontWeight: FontWeight.w600,
            ),
          ),
          const SizedBox(height: 12),
          Row(
            children: [
              Expanded(
                child: ElevatedButton(
                  onPressed: onApprove,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: AppColors.success,
                  ),
                  child: Text('✅ ${'approve'.tr()}'),
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: ElevatedButton(
                  onPressed: onReject,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: AppColors.error,
                  ),
                  child: Text('❌ ${'reject'.tr()}'),
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }
}

/// Dialog to collect rejection reason
class _RejectReasonDialog extends StatelessWidget {
  final TextEditingController _controller = TextEditingController();

  _RejectReasonDialog();

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: Text('reject_reason'.tr()),
      content: TextField(
        controller: _controller,
        maxLines: 3,
        autofocus: true,
        decoration: InputDecoration(
          hintText: 'reject_reason_hint'.tr(),
        ),
      ),
      actions: [
        TextButton(
          onPressed: () => Navigator.of(context).pop(),
          child: Text('cancel'.tr()),
        ),
        ElevatedButton(
          onPressed: () => Navigator.of(context).pop(_controller.text.trim()),
          child: Text('confirm'.tr()),
        ),
      ],
    );
  }
}
