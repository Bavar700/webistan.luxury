import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:ofarin/l10n/app_localizations.dart';
import '../../../constants/app_colors.dart';
import '../../../routing/route_constants.dart';
import '../../auth/data/auth_repository.dart';
import '../../auth/domain/auth_state.dart';
import '../../tasks/data/task_repository.dart';
import '../../economy/data/economy_repository.dart';

class ChildDashboardScreen extends ConsumerStatefulWidget {
  const ChildDashboardScreen({super.key});

  @override
  ConsumerState<ChildDashboardScreen> createState() => _ChildDashboardScreenState();
}

class _ChildDashboardScreenState extends ConsumerState<ChildDashboardScreen> {
  bool _isReloading = false;
  Future<List<dynamic>>? _combinedFuture;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      ref.read(appModeProvider.notifier).refreshActiveChild();
    });
  }

  void _loadDashboardData(String childId) {
    final taskRepo = ref.read(taskRepositoryProvider);
    final economyRepo = ref.read(economyRepositoryProvider);
    _combinedFuture = Future.wait([
      taskRepo.fetchTasksForChild(childId),
      economyRepo.fetchWishlistForChild(childId),
    ]);
  }

  void _reloadTasks() {
    final appModeState = ref.read(appModeProvider);
    if (appModeState.activeChild != null) {
      _loadDashboardData(appModeState.activeChild!.id);
    }
    setState(() {
      _isReloading = !_isReloading;
    });
  }

  void _markTaskAsDone(TaskModel task, [String? comment, String? imageUrl]) async {
    final localizations = AppLocalizations.of(context);
    final taskRepo = ref.read(taskRepositoryProvider);
    try {
      await taskRepo.updateTaskStatus(
        task.id,
        'done_pending_approval',
        submissionComment: comment,
        submissionImageUrl: imageUrl,
      );
      _reloadTasks();
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('${localizations?.taskSentReviewDesc ?? "Офарин! Супориш иҷро шуд ва барои тасдиқ ба волидайн фиристода шуд."} 🎉'),
            backgroundColor: AppColors.primary,
            behavior: SnackBarBehavior.floating,
          ),
        );
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('${localizations?.errorLabel ?? "Хатогӣ:"} $e'), backgroundColor: AppColors.error),
        );
      }
    }
  }

  void _showCompleteTaskDialog(TaskModel task) {
    final localizations = AppLocalizations.of(context);
    final TextEditingController commentController = TextEditingController();
    String? selectedImageUrl;
    
    final List<Map<String, String>> mockProofs = [
      {
        'label': 'Рӯбучин 🧹',
        'url': 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=400&q=80',
      },
      {
        'label': 'Дарсҳо 📖',
        'url': 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=400&q=80',
      },
      {
        'label': 'Ошхона 🍳',
        'url': 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=400&q=80',
      },
      {
        'label': 'Китобхонӣ 📚',
        'url': 'https://images.unsplash.com/photo-1506880018603-83d5b814b5a6?auto=format&fit=crop&w=400&q=80',
      },
      {
        'label': 'Тайёр 👍',
        'url': 'https://images.unsplash.com/photo-1572245244575-d8667596c06a?auto=format&fit=crop&w=400&q=80',
      },
    ];

    showDialog(
      context: context,
      builder: (ctx) {
        return StatefulBuilder(
          builder: (context, setDialogState) {
            return AlertDialog(
              backgroundColor: AppColors.bgLight,
              shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
              title: const Row(
                children: [
                  Icon(Icons.stars_rounded, color: AppColors.accent, size: 28),
                  SizedBox(width: 8),
                  Expanded(
                    child: Text(
                      'Тасдиқи иҷрошавӣ',
                      style: TextStyle(fontWeight: FontWeight.bold, fontSize: 18, color: AppColors.textPrimaryLight),
                    ),
                  ),
                ],
              ),
              content: SingleChildScrollView(
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      'Вазифаи "${task.title}"-ро иҷро кардед? Шарҳ нависед ё акси худро интихоб кунед:',
                      style: const TextStyle(fontSize: 13, color: AppColors.textSecondaryLight),
                    ),
                    const SizedBox(height: 12),
                    TextField(
                      controller: commentController,
                      maxLines: 2,
                      decoration: InputDecoration(
                        hintText: 'Масалан: Ман ҳамаашро тоза кардам! 🌟',
                        hintStyle: const TextStyle(fontSize: 13, color: Colors.grey),
                        contentPadding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
                        filled: true,
                        fillColor: Colors.white,
                        enabledBorder: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(8),
                          borderSide: BorderSide(color: Colors.grey.shade300),
                        ),
                        focusedBorder: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(8),
                          borderSide: const BorderSide(color: AppColors.accent),
                        ),
                      ),
                    ),
                    const SizedBox(height: 16),
                    const Text(
                      'Акси тасдиқкунанда (факултативӣ):',
                      style: TextStyle(fontWeight: FontWeight.bold, fontSize: 13, color: AppColors.textPrimaryLight),
                    ),
                    const SizedBox(height: 8),
                    SizedBox(
                      height: 80,
                      child: ListView.separated(
                        scrollDirection: Axis.horizontal,
                        itemCount: mockProofs.length,
                        separatorBuilder: (_, __) => const SizedBox(width: 8),
                        itemBuilder: (context, idx) {
                          final item = mockProofs[idx];
                          final isSelected = selectedImageUrl == item['url'];
                          return GestureDetector(
                            onTap: () {
                              setDialogState(() {
                                selectedImageUrl = isSelected ? null : item['url'];
                              });
                            },
                            child: Stack(
                              children: [
                                Container(
                                  width: 80,
                                  height: 80,
                                  decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(8),
                                    border: Border.all(
                                      color: isSelected ? AppColors.accent : Colors.grey.shade300,
                                      width: isSelected ? 2 : 1,
                                    ),
                                    image: DecorationImage(
                                      image: NetworkImage(item['url']!),
                                      fit: BoxFit.cover,
                                    ),
                                  ),
                                ),
                                if (isSelected)
                                  Container(
                                    width: 80,
                                    height: 80,
                                    decoration: BoxDecoration(
                                      color: Colors.black26,
                                      borderRadius: BorderRadius.circular(8),
                                    ),
                                    child: const Icon(Icons.check_circle, color: Colors.white, size: 28),
                                  ),
                                Positioned(
                                  bottom: 4,
                                  left: 4,
                                  right: 4,
                                  child: Container(
                                    padding: const EdgeInsets.symmetric(vertical: 2),
                                    color: Colors.black54,
                                    child: Text(
                                      item['label']!,
                                      textAlign: TextAlign.center,
                                      style: const TextStyle(color: Colors.white, fontSize: 9, fontWeight: FontWeight.bold),
                                    ),
                                  ),
                                ),
                              ],
                            ),
                          );
                        },
                      ),
                    ),
                  ],
                ),
              ),
              actions: [
                TextButton(
                  onPressed: () => Navigator.of(ctx).pop(),
                  child: Text(localizations?.cancel ?? 'Бекор кардан', style: const TextStyle(color: AppColors.textSecondaryLight)),
                ),
                ElevatedButton(
                  onPressed: () {
                    Navigator.of(ctx).pop();
                    _markTaskAsDone(
                      task,
                      commentController.text.trim(),
                      selectedImageUrl,
                    );
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: AppColors.accent,
                    foregroundColor: Colors.white,
                  ),
                  child: Text(localizations?.send ?? 'Фиристодан'),
                ),
              ],
            );
          },
        );
      },
    );
  }

  void _startTimerTask(TaskModel task) {
    context.go(
      RoutePaths.childTimer,
      extra: {
        'taskId': task.id,
        'title': task.title,
        'duration': task.timerDurationSeconds ?? 1200,
      },
    );
  }


  Widget _buildTaskCard(
    BuildContext context,
    TaskModel task,
    UserProfile child,
  ) {
    final localizations = AppLocalizations.of(context);
    IconData typeIcon;
    Color typeColor;
    String typeLabel;
    
    switch (task.taskType) {
      case 'routine':
        typeIcon = Icons.cached_rounded;
        typeColor = AppColors.info;
        typeLabel = 'Реҷаи рӯзона';
        break;
      case 'deadline':
        typeIcon = Icons.calendar_month_outlined;
        typeColor = AppColors.warning;
        typeLabel = 'Бо муҳлат';
        break;
      case 'bonus':
        typeIcon = Icons.monetization_on_outlined;
        typeColor = AppColors.success;
        typeLabel = 'Бонусӣ';
        break;
      case 'timer_lock':
        typeIcon = Icons.timer_outlined;
        typeColor = Colors.purple;
        typeLabel = 'Таймери ҳатмӣ';
        break;
      default:
        typeIcon = Icons.task_alt_rounded;
        typeColor = AppColors.primary;
        typeLabel = 'Вазифа';
    }

    return Container(
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(24),
        border: Border.all(color: typeColor.withOpacity(0.2), width: 1.5),
        boxShadow: [
          BoxShadow(
            color: typeColor.withOpacity(0.06),
            blurRadius: 16,
            offset: const Offset(0, 6),
          )
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          Padding(
            padding: const EdgeInsets.all(18),
            child: Row(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // Icon Badge with glassmorphic style
                Container(
                  width: 48,
                  height: 48,
                  decoration: BoxDecoration(
                    gradient: LinearGradient(
                      colors: [typeColor.withOpacity(0.18), typeColor.withOpacity(0.04)],
                      begin: Alignment.topLeft,
                      end: Alignment.bottomRight,
                    ),
                    borderRadius: BorderRadius.circular(16),
                    border: Border.all(color: typeColor.withOpacity(0.2), width: 1.2),
                  ),
                  child: Icon(typeIcon, color: typeColor, size: 24),
                ),
                const SizedBox(width: 14),

                // Content
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        task.title,
                        style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16, color: AppColors.textPrimaryLight),
                      ),
                      if (task.description != null) ...[
                        const SizedBox(height: 4),
                        Text(
                          task.description!,
                          style: const TextStyle(fontSize: 13, color: AppColors.textSecondaryLight),
                        ),
                      ],
                    ],
                  ),
                ),
                const SizedBox(width: 8),

                // Reward Badge styled like a game coin
                Container(
                  padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 6),
                  decoration: BoxDecoration(
                    color: task.rewardType == 'stars' ? Colors.amber.shade50 : Colors.green.shade50,
                    borderRadius: BorderRadius.circular(12),
                    border: Border.all(
                      color: task.rewardType == 'stars' ? Colors.amber.shade200 : Colors.green.shade200,
                      width: 1,
                    ),
                  ),
                  child: Row(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      Text(
                        task.rewardType == 'stars' 
                            ? '+${task.rewardAmount.toInt()}' 
                            : '+${task.rewardAmount.toStringAsFixed(1)}',
                        style: TextStyle(
                          fontSize: 16,
                          fontWeight: FontWeight.bold,
                          color: task.rewardType == 'stars' ? Colors.amber.shade900 : Colors.green.shade900,
                        ),
                      ),
                      const SizedBox(width: 4),
                      Icon(
                        task.rewardType == 'stars' ? Icons.star_rounded : Icons.account_balance_wallet_rounded,
                        color: task.rewardType == 'stars' ? Colors.amber : Colors.green,
                        size: 18,
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),
          const Divider(height: 1, color: AppColors.borderLight),
          // ===== STATUS-BASED BOTTOM SECTION =====
          if (task.status == 'done_pending_approval') ...[
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
              color: Colors.orange.shade50,
              child: Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  const Icon(Icons.hourglass_empty_rounded, color: Colors.orange, size: 16),
                  const SizedBox(width: 8),
                  Text(
                    localizations?.pendingApprovalBadge ?? 'Дар интизори тасдиқи волидайн...',
                    style: TextStyle(fontWeight: FontWeight.bold, fontSize: 12, color: Colors.orange.shade800),
                  ),
                ],
              ),
            ),
          ] else if (task.status == 'completed') ...[
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
              color: Colors.green.shade50,
              child: Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  const Icon(Icons.emoji_events_rounded, color: AppColors.success, size: 16),
                  const SizedBox(width: 8),
                  Text(
                    '${localizations?.taskApproved ?? "Тасдиқ шуд!"} +${task.rewardAmount.toInt()} ${localizations?.pointsText ?? "хол"}',
                    style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 12, color: AppColors.success),
                  ),
                ],
              ),
            ),
          ] else ...[
            // todo or in_progress — show action buttons
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
              color: const Color(0xFFFBFBFB),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.end,
                children: [
                  if (task.taskType == 'timer_lock') ...[
                    GestureDetector(
                      onTap: () => _startTimerTask(task),
                      child: Container(
                        height: 38,
                        padding: const EdgeInsets.symmetric(horizontal: 14),
                        alignment: Alignment.center,
                        decoration: BoxDecoration(
                          color: Colors.purple,
                          borderRadius: BorderRadius.circular(8),
                        ),
                        child: Row(
                          mainAxisSize: MainAxisSize.min,
                          children: [
                            Icon(Icons.play_arrow_rounded, color: Colors.white, size: 16),
                            SizedBox(width: 6),
                            Text(
                              localizations?.startTimer ?? 'Оғози таймер',
                              style: const TextStyle(
                                color: Colors.white,
                                fontSize: 13,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                    const SizedBox(width: 8),
                  ],
                  GestureDetector(
                    onTap: () => _showCompleteTaskDialog(task),
                    child: Container(
                      height: 38,
                      padding: const EdgeInsets.symmetric(horizontal: 16),
                      alignment: Alignment.center,
                      decoration: BoxDecoration(
                        color: AppColors.success,
                        borderRadius: BorderRadius.circular(8),
                        boxShadow: [
                          BoxShadow(
                            color: AppColors.success.withOpacity(0.25),
                            blurRadius: 8,
                            offset: const Offset(0, 3),
                          ),
                        ],
                      ),
                      child: Row(
                        mainAxisSize: MainAxisSize.min,
                        children: [
                          Icon(Icons.check_circle_rounded, color: Colors.white, size: 16),
                          SizedBox(width: 8),
                          Text(
                            '${localizations?.markDone ?? "Иҷро шуд"} ✓',
                            style: const TextStyle(
                              color: Colors.white,
                              fontWeight: FontWeight.bold,
                              fontSize: 13,
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ],
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    final appModeState = ref.watch(appModeProvider);
    final localizations = AppLocalizations.of(context);

    if (appModeState.activeChild == null) {
      return Scaffold(
        body: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              const Text('🧒', style: TextStyle(fontSize: 64)),
              const SizedBox(height: 16),
              Text(localizations?.profileNotSelected ?? 'Профил интихоб нашудааст',
                  style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
              const SizedBox(height: 16),
              ElevatedButton(
                onPressed: () => context.go(RoutePaths.modeSelection),
                child: Text(localizations?.selectProfile ?? 'Интихоби Профил'),
              ),
            ],
          ),
        ),
      );
    }

    final child = appModeState.activeChild!;
    if (_combinedFuture == null) {
      _loadDashboardData(child.id);
    }
    final combinedFuture = _combinedFuture!;

    final String txtMyTasks = localizations?.myTasks ?? 'Вазифаҳои Ман';
    final String txtMyWishlist = localizations?.myWishlist ?? 'Орзуҳои Ман';
    final String txtMyWallet = localizations?.myWallet ?? 'Ҳамёни Ман';

    const double targetWishCost = 60.00;
    final double progressPercent =
        (child.fiatBalance / targetWishCost).clamp(0.0, 1.0);

    return Scaffold(
      body: Container(
        decoration: const BoxDecoration(gradient: AppColors.childBgGradient),
        child: SafeArea(
          child: SingleChildScrollView(
            physics: const ClampingScrollPhysics(),
            child: Column(
              children: [
                // ===== HEADER =====
                Container(
                  padding: const EdgeInsets.fromLTRB(20, 16, 20, 24),
                  decoration: const BoxDecoration(
                    gradient: AppColors.primaryGradient,
                    borderRadius: BorderRadius.vertical(bottom: Radius.circular(32)),
                  ),
                  child: Column(
                    children: [
                      Row(
                        children: [
                          // Back button
                          GestureDetector(
                            onTap: () {
                              ref.read(appModeProvider.notifier).exitMode();
                              context.go(RoutePaths.modeSelection);
                            },
                            child: Container(
                              padding: const EdgeInsets.all(8),
                              decoration: BoxDecoration(
                                color: Colors.white.withOpacity(0.2),
                                shape: BoxShape.circle,
                              ),
                              child: const Icon(Icons.arrow_back_ios_new_rounded,
                                  color: Colors.white, size: 18),
                            ),
                          ),
                          const Spacer(),
                          // Streak badge
                          Container(
                            padding: const EdgeInsets.symmetric(
                                horizontal: 14, vertical: 6),
                            decoration: BoxDecoration(
                              color: Colors.white.withOpacity(0.2),
                              borderRadius: BorderRadius.circular(20),
                            ),
                            child: Row(
                              children: [
                                const Text('🔥', style: TextStyle(fontSize: 16)),
                                const SizedBox(width: 6),
                                Text(
                                  '${child.streakCount} рӯз',
                                  style: const TextStyle(
                                      color: Colors.white,
                                      fontWeight: FontWeight.bold),
                                ),
                              ],
                            ),
                          ),
                        ],
                      ),
                      const SizedBox(height: 20),
                      // Avatar
                      Container(
                        width: 80,
                        height: 80,
                        decoration: BoxDecoration(
                          color: Colors.white.withOpacity(0.25),
                          shape: BoxShape.circle,
                          border: Border.all(color: Colors.white, width: 3),
                        ),
                        child: Center(
                          child: Text(child.avatarUrl ?? '🦊',
                              style: const TextStyle(fontSize: 40)),
                        ),
                      ),
                      const SizedBox(height: 12),
                      Text(
                        '${localizations?.helloChild ?? "Салом"}, ${child.displayName}! 👋',
                        style: const TextStyle(
                          fontSize: 22,
                          fontWeight: FontWeight.bold,
                          color: Colors.white,
                        ),
                      ),
                      const SizedBox(height: 4),
                      Text(
                        localizations?.todayHero ?? 'Имрӯз ҳам қаҳрамон бош! 💪',
                        style: const TextStyle(color: Colors.white70, fontSize: 14),
                      ),
                    ],
                  ),
                ),

                const SizedBox(height: 24),

                // ===== WALLET CARDS =====
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 20),
                  child: Row(
                    children: [
                      Expanded(
                        child: _WalletCard(
                          emoji: '⭐',
                          value: '${child.starsBalance}',
                          label: localizations?.stars ?? 'Ситораҳо',
                          gradient: AppColors.accentGradient,
                        ),
                      ),
                      const SizedBox(width: 16),
                      Expanded(
                        child: _WalletCard(
                          emoji: '💰',
                          value: child.fiatBalance.toStringAsFixed(2),
                          label: localizations?.fiat ?? 'Сомонӣ',
                          gradient: AppColors.successGradient,
                        ),
                      ),
                    ],
                  ),
                ),

                const SizedBox(height: 20),

                // ===== GOAL TRACKER =====
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 20),
                  child: Container(
                    padding: const EdgeInsets.all(20),
                    decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: BorderRadius.circular(24),
                      boxShadow: [
                        BoxShadow(
                          color: AppColors.primary.withOpacity(0.08),
                          blurRadius: 16,
                          offset: const Offset(0, 6),
                        )
                      ],
                    ),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Row(
                          children: [
                            const Text('🎁', style: TextStyle(fontSize: 20)),
                            const SizedBox(width: 8),
                            const Expanded(
                              child: Text(
                                'Мақсади орзу',
                                style: TextStyle(
                                    fontWeight: FontWeight.bold, fontSize: 16),
                              ),
                            ),
                            Container(
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 10, vertical: 4),
                              decoration: BoxDecoration(
                                color: AppColors.accent.withOpacity(0.15),
                                borderRadius: BorderRadius.circular(12),
                              ),
                              child: Text(
                                '${(progressPercent * 100).toInt()}%',
                                style: const TextStyle(
                                    color: AppColors.accentDark,
                                    fontWeight: FontWeight.bold),
                              ),
                            ),
                          ],
                        ),
                        const SizedBox(height: 8),
                        const Text('Конструктори Lego Set 🦊',
                            style: TextStyle(fontWeight: FontWeight.w600)),
                        const SizedBox(height: 12),
                        ClipRRect(
                          borderRadius: BorderRadius.circular(10),
                          child: LinearProgressIndicator(
                            value: progressPercent,
                            minHeight: 14,
                            backgroundColor: AppColors.bgLight,
                            valueColor: const AlwaysStoppedAnimation<Color>(
                                AppColors.accent),
                          ),
                        ),
                        const SizedBox(height: 8),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Text(
                              '${child.fiatBalance.toStringAsFixed(2)} сомонӣ',
                              style: const TextStyle(
                                  fontSize: 12,
                                  color: AppColors.textSecondaryLight),
                            ),
                            Text(
                              'Мақсад: $targetWishCost сомонӣ',
                              style: const TextStyle(
                                  fontSize: 12,
                                  fontWeight: FontWeight.bold,
                                  color: AppColors.textSecondaryLight),
                            ),
                          ],
                        ),
                      ],
                    ),
                  ),
                ),

                const SizedBox(height: 24),

                FutureBuilder<List<dynamic>>(
                  key: ValueKey('${child.id}_$_isReloading'),
                  future: combinedFuture,
                  builder: (context, snapshot) {
                    if (snapshot.connectionState == ConnectionState.waiting) {
                      return const Padding(
                        padding: EdgeInsets.all(32.0),
                        child: Center(child: CircularProgressIndicator(color: AppColors.accent)),
                      );
                    }

                    final data = snapshot.data ?? [[], []];
                    final List<TaskModel> tasks = List<TaskModel>.from(data[0]);
                    final List<WishlistItemModel> wishes = List<WishlistItemModel>.from(data[1]);

                    final activeTasks = tasks.where((t) => t.status == 'todo' || t.status == 'in_progress').toList();
                    // Show ALL tasks so button is always visible; each card shows status
                    final pendingWishesCount = wishes.where((w) => w.status == 'approved' || w.status == 'pending').length;

                    return Column(
                      children: [
                        // ===== MENU HEADING =====
                        Padding(
                          padding: EdgeInsets.symmetric(horizontal: 20),
                          child: Align(
                            alignment: Alignment.centerLeft,
                            child: Text(
                              localizations?.todayPlans ?? '📋 Нақшаҳои имрӯза',
                              style: TextStyle(
                                  fontSize: 18,
                                  fontWeight: FontWeight.bold,
                                  color: AppColors.textPrimaryLight),
                            ),
                          ),
                        ),
                        const SizedBox(height: 14),

                        // ===== MENU CARDS =====
                        Padding(
                          padding: const EdgeInsets.symmetric(horizontal: 20),
                          child: Column(
                            children: [
                              _MenuCard(
                                emoji: '✅',
                                title: txtMyTasks,
                                subtitle: localizations?.tasksSubtitle ?? 'Вазифаҳоро иҷро кун ва холҳо гир!',
                                badge: '${activeTasks.length} ${localizations?.activeBadge ?? "фаъол"}',
                                gradient: AppColors.primaryGradient,
                                onTap: () => context.go(RoutePaths.childTasks),
                              ),
                              const SizedBox(height: 14),
                              _MenuCard(
                                emoji: '🎁',
                                title: txtMyWishlist,
                                subtitle: localizations?.wishlistSubtitle ?? 'Рӯйхати орзуҳои ту',
                                badge: '$pendingWishesCount ${localizations?.pendingBadge ?? "интизорӣ"}',
                                gradient: AppColors.accentGradient,
                                onTap: () => context.go(RoutePaths.childWishlist),
                              ),
                              const SizedBox(height: 14),
                              _MenuCard(
                                emoji: '💎',
                                title: txtMyWallet,
                                subtitle: localizations?.walletSubtitle ?? 'Таърихи холҳо ва мукофотҳо',
                                badge: localizations?.transactionsBadge ?? 'Муомилот',
                                gradient: AppColors.successGradient,
                                onTap: () => context.go(RoutePaths.childWallet),
                              ),
                            ],
                          ),
                        ),

                        // ===== DYNAMIC ACTIVE TASKS LIST =====
                        if (tasks.isNotEmpty) ...[
                          const SizedBox(height: 24),
                          Padding(
                            padding: EdgeInsets.symmetric(horizontal: 20),
                            child: Align(
                              alignment: Alignment.centerLeft,
                              child: Text(
                                '${localizations?.myTasksList ?? "🎯 Вазифаҳои ман"} (🎯)',
                                style: TextStyle(
                                    fontSize: 18,
                                    fontWeight: FontWeight.bold,
                                    color: AppColors.textPrimaryLight),
                              ),
                            ),
                          ),
                          const SizedBox(height: 14),
                          Padding(
                            padding: const EdgeInsets.symmetric(horizontal: 20),
                            child: ListView.separated(
                              shrinkWrap: true,
                              physics: const NeverScrollableScrollPhysics(),
                              itemCount: tasks.length,
                              separatorBuilder: (_, __) => const SizedBox(height: 12),
                              itemBuilder: (context, index) {
                                final task = tasks[index];
                                return _buildTaskCard(context, task, child);
                              },
                            ),
                          ),
                        ] else ...[
                          const SizedBox(height: 24),
                          Padding(
                            padding: const EdgeInsets.symmetric(horizontal: 20),
                            child: Container(
                              padding: const EdgeInsets.all(20),
                              decoration: BoxDecoration(
                                color: Colors.white,
                                borderRadius: BorderRadius.circular(16),
                                border: Border.all(color: AppColors.borderLight),
                              ),
                              child: Row(
                                children: [
                                  Text('📋', style: TextStyle(fontSize: 24)),
                                  SizedBox(width: 12),
                                  Expanded(
                                    child: Text(
                                      localizations?.parentsNotCreatedTasks ?? 'Волидайн ҳанӯз вазифа эҷод накардаанд.',
                                      style: TextStyle(
                                        color: AppColors.textSecondaryLight,
                                        fontWeight: FontWeight.w600,
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                            ),
                          ),
                        ],
                      ],
                    );
                  },
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

class _WalletCard extends StatelessWidget {
  final String emoji;
  final String value;
  final String label;
  final Gradient gradient;

  const _WalletCard({
    required this.emoji,
    required this.value,
    required this.label,
    required this.gradient,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(18),
      decoration: BoxDecoration(
        gradient: gradient,
        borderRadius: BorderRadius.circular(22),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.12),
            blurRadius: 16,
            offset: const Offset(0, 6),
          )
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(emoji, style: const TextStyle(fontSize: 28)),
          const SizedBox(height: 10),
          Text(
            value,
            style: const TextStyle(
              fontSize: 26,
              fontWeight: FontWeight.w900,
              color: Colors.white,
            ),
          ),
          const SizedBox(height: 2),
          Text(
            label,
            style: const TextStyle(color: Colors.white70, fontSize: 12),
          ),
        ],
      ),
    );
  }
}

class _MenuCard extends StatefulWidget {
  final String emoji;
  final String title;
  final String subtitle;
  final String badge;
  final Gradient gradient;
  final VoidCallback onTap;

  const _MenuCard({
    required this.emoji,
    required this.title,
    required this.subtitle,
    required this.badge,
    required this.gradient,
    required this.onTap,
  });

  @override
  State<_MenuCard> createState() => _MenuCardState();
}

class _MenuCardState extends State<_MenuCard> {
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
        scale: _pressed ? 0.97 : 1.0,
        duration: const Duration(milliseconds: 100),
        child: Container(
          padding: const EdgeInsets.all(18),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(22),
            boxShadow: [
              BoxShadow(
                color: Colors.black.withOpacity(0.06),
                blurRadius: 12,
                offset: const Offset(0, 4),
              )
            ],
          ),
          child: Row(
            children: [
              // Gradient icon box
              Container(
                width: 58,
                height: 58,
                decoration: BoxDecoration(
                  gradient: widget.gradient,
                  borderRadius: BorderRadius.circular(16),
                ),
                child: Center(
                  child: Text(widget.emoji,
                      style: const TextStyle(fontSize: 28)),
                ),
              ),
              const SizedBox(width: 16),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Row(
                      children: [
                        Expanded(
                          child: Text(
                            widget.title,
                            style: const TextStyle(
                              fontWeight: FontWeight.bold,
                              fontSize: 16,
                              color: AppColors.textPrimaryLight,
                            ),
                          ),
                        ),
                        Container(
                          padding: const EdgeInsets.symmetric(
                              horizontal: 10, vertical: 3),
                          decoration: BoxDecoration(
                            color: AppColors.bgLight,
                            borderRadius: BorderRadius.circular(10),
                          ),
                          child: Text(
                            widget.badge,
                            style: const TextStyle(
                              fontSize: 11,
                              fontWeight: FontWeight.bold,
                              color: AppColors.textSecondaryLight,
                            ),
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 4),
                    Text(
                      widget.subtitle,
                      style: const TextStyle(
                          fontSize: 12, color: AppColors.textSecondaryLight),
                    ),
                  ],
                ),
              ),
              const SizedBox(width: 8),
              const Icon(Icons.arrow_forward_ios_rounded,
                  size: 16, color: AppColors.primaryLight),
            ],
          ),
        ),
      ),
    );
  }
}
