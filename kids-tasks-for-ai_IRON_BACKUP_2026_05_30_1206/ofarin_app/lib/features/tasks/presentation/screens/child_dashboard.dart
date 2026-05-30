// ══════════════════════════════════════════════════════════════════════════════
// Child Dashboard — Main screen for children to see tasks and stats
// ══════════════════════════════════════════════════════════════════════════════

import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:shimmer/shimmer.dart';
import '../../../../core/theme/app_colors.dart';
import '../../../../core/utils/snackbar_helper.dart';
import '../../../wallet/presentation/widgets/balance_display.dart';
import '../widgets/task_card.dart';
import '../../data/enums/task_status.dart';

class ChildDashboard extends StatefulWidget {
  const ChildDashboard({super.key});

  @override
  State<ChildDashboard> createState() => _ChildDashboardState();
}

class _ChildDashboardState extends State<ChildDashboard> {
  bool _isLoading = true;

  @override
  void initState() {
    super.initState();
    _loadData();
  }

  Future<void> _loadData() async {
    // Simulate loading for shimmer demo
    setState(() => _isLoading = true);
    await Future.delayed(const Duration(milliseconds: 800));
    if (mounted) {
      setState(() => _isLoading = false);
    }
  }

  Future<void> _onRefresh() async {
    await _loadData();
    if (mounted) {
      context.showSuccess('refresh_complete'.tr());
    }
  }

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
          child: RefreshIndicator(
            onRefresh: _onRefresh,
            color: AppColors.primary,
            backgroundColor: AppColors.surfaceDark,
            child: SingleChildScrollView(
              physics: const AlwaysScrollableScrollPhysics(),
              padding: const EdgeInsets.all(20),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  const SizedBox(height: 16),
                  // Balance display
                  const BalanceDisplay(),
                  const SizedBox(height: 24),
                  // Active tasks header
                  if (!_isLoading) ...[
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        Text(
                          'tasks'.tr(),
                          style: const TextStyle(
                            fontSize: 22,
                            fontWeight: FontWeight.w700,
                            color: AppColors.textPrimary,
                          ),
                        ),
                        Container(
                          padding: const EdgeInsets.symmetric(
                            horizontal: 12,
                            vertical: 6,
                          ),
                          decoration: BoxDecoration(
                            color: AppColors.primary.withValues(alpha: 0.15),
                            borderRadius: BorderRadius.circular(20),
                          ),
                          child: Text(
                            '3 ${'active'.tr()}',
                            style: const TextStyle(
                              color: AppColors.primary,
                              fontWeight: FontWeight.w600,
                              fontSize: 13,
                            ),
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 16),
                    _buildTaskList(context),
                  ] else
                    _buildShimmerLoading(),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildShimmerLoading() {
    return Shimmer.fromColors(
      baseColor: AppColors.surfaceDark,
      highlightColor: const Color(0xFF2A2A5E),
      child: Column(
        children: List.generate(
          3,
          (index) => Padding(
            padding: const EdgeInsets.only(bottom: 12),
            child: Container(
              height: 88,
              decoration: BoxDecoration(
                color: AppColors.surfaceDark,
                borderRadius: BorderRadius.circular(16),
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildTaskList(BuildContext context) {
    // Sample tasks for UI demonstration
    final sampleTasks = [
      _SampleTask(
        title: 'Убрать комнату',
        description: 'Сложить вещи, пропылесосить, вытереть пыль',
        rewardAmount: '5',
        rewardCurrency: '⭐',
        status: TaskStatus.active,
      ),
      _SampleTask(
        title: 'Помыть посуду',
        description: 'Помыть всю посуду после ужина',
        rewardAmount: '3',
        rewardCurrency: '⭐',
        status: TaskStatus.active,
      ),
      _SampleTask(
        title: 'Сделать домашнее задание',
        description: 'Математика: стр. 45-47, Русский: упр. 12',
        rewardAmount: '1',
        rewardCurrency: '💰',
        status: TaskStatus.active,
      ),
    ];

    return Column(
      children: sampleTasks.map((task) {
        return TaskCard(
          title: task.title,
          description: task.description,
          rewardAmount: task.rewardAmount,
          rewardCurrency: task.rewardCurrency,
          status: task.status,
          onTap: () => context.go('/child/timer/demo'),
          onStartTimer: () => context.go('/child/timer/demo?duration=15'),
        );
      }).toList(),
    );
  }
}

class _SampleTask {
  final String title;
  final String description;
  final String rewardAmount;
  final String rewardCurrency;
  final TaskStatus status;

  const _SampleTask({
    required this.title,
    required this.description,
    required this.rewardAmount,
    required this.rewardCurrency,
    required this.status,
  });
}
