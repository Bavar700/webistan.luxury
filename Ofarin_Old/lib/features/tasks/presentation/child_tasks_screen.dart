import 'package:flutter/material.dart';
import 'dart:convert';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:image_picker/image_picker.dart';
import 'package:ofarin/l10n/app_localizations.dart';
import '../../../constants/app_colors.dart';
import '../../../constants/app_sizes.dart';
import '../../../routing/route_constants.dart';
import '../../auth/data/auth_repository.dart';
import '../../auth/domain/auth_state.dart';
import '../data/task_repository.dart';

class ChildTasksScreen extends ConsumerStatefulWidget {
  const ChildTasksScreen({super.key});

  @override
  ConsumerState<ChildTasksScreen> createState() => _ChildTasksScreenState();
}

class _ChildTasksScreenState extends ConsumerState<ChildTasksScreen> with SingleTickerProviderStateMixin {
  late TabController _tabController;
  bool _isReloading = false;

  @override
  void initState() {
    super.initState();
    _tabController = TabController(length: 3, vsync: this);
    WidgetsBinding.instance.addPostFrameCallback((_) {
      ref.read(appModeProvider.notifier).refreshActiveChild();
    });
  }

  @override
  void dispose() {
    _tabController.dispose();
    super.dispose();
  }

  void _reloadTasks() {
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

    Future<void> pickImage(StateSetter setDialogState) async {
      try {
        final picker = ImagePicker();
        XFile? image;
        try {
          image = await picker.pickImage(
            source: ImageSource.camera,
            maxWidth: 800,
            maxHeight: 600,
            imageQuality: 85,
          );
        } catch (_) {
          // Fallback to gallery if camera access throws permission error
          image = await picker.pickImage(
            source: ImageSource.gallery,
            maxWidth: 800,
            maxHeight: 600,
            imageQuality: 85,
          );
        }
        if (image != null) {
          final bytes = await image.readAsBytes();
          final base64String = 'data:image/jpeg;base64,${base64Encode(bytes)}';
          setDialogState(() {
            selectedImageUrl = base64String;
          });
        }
      } catch (e) {
        debugPrint('Error picking image: $e');
      }
    }

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
                      'Акси тасдиқкунанда:',
                      style: TextStyle(fontWeight: FontWeight.bold, fontSize: 13, color: AppColors.textPrimaryLight),
                    ),
                    const SizedBox(height: 8),
                    GestureDetector(
                      onTap: () => pickImage(setDialogState),
                      child: Container(
                        padding: const EdgeInsets.symmetric(vertical: 10, horizontal: 12),
                        decoration: BoxDecoration(
                          color: AppColors.primary,
                          borderRadius: BorderRadius.circular(8),
                        ),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: const [
                            Icon(Icons.camera_alt_rounded, color: Colors.white, size: 18),
                            SizedBox(width: 8),
                            Text(
                              'Акс гирифтан бо телефон 📸',
                              style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 13),
                            ),
                          ],
                        ),
                      ),
                    ),
                    const SizedBox(height: 12),
                    if (selectedImageUrl != null) ...[
                      Center(
                        child: Container(
                          width: 120,
                          height: 120,
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(12),
                            border: Border.all(color: AppColors.accent, width: 2),
                          ),
                          child: ClipRRect(
                            borderRadius: BorderRadius.circular(10),
                            child: selectedImageUrl!.startsWith('data:image')
                                ? Image.memory(
                                    base64Decode(selectedImageUrl!.split(',').last),
                                    fit: BoxFit.cover,
                                  )
                                : Image.network(
                                    selectedImageUrl!,
                                    fit: BoxFit.cover,
                                  ),
                          ),
                        ),
                      ),
                      const SizedBox(height: 12),
                    ],
                    const Text(
                      'Шаблонҳои омодашуда (факултативӣ):',
                      style: TextStyle(fontSize: 12, color: AppColors.textSecondaryLight),
                    ),
                    const SizedBox(height: 6),
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
              actionsPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
              actions: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.end,
                  children: [
                    GestureDetector(
                      onTap: () => Navigator.of(ctx).pop(),
                      child: Container(
                        height: 38,
                        padding: const EdgeInsets.symmetric(horizontal: 16),
                        alignment: Alignment.center,
                        decoration: BoxDecoration(
                          color: Colors.transparent,
                          border: Border.all(color: AppColors.borderLight, width: 1.5),
                          borderRadius: BorderRadius.circular(8),
                        ),
                        child: Text(
                          localizations?.cancel ?? 'Бекор кардан',
                          style: const TextStyle(
                            color: AppColors.textSecondaryLight,
                            fontWeight: FontWeight.bold,
                            fontSize: 13,
                          ),
                        ),
                      ),
                    ),
                    const SizedBox(width: 8),
                    GestureDetector(
                      onTap: () {
                        Navigator.of(ctx).pop();
                        _markTaskAsDone(
                          task,
                          commentController.text.trim(),
                          selectedImageUrl,
                        );
                      },
                      child: Container(
                        height: 38,
                        padding: const EdgeInsets.symmetric(horizontal: 16),
                        alignment: Alignment.center,
                        decoration: BoxDecoration(
                          color: AppColors.accent,
                          borderRadius: BorderRadius.circular(8),
                          boxShadow: [
                            BoxShadow(
                              color: AppColors.accent.withOpacity(0.2),
                              blurRadius: 4,
                              offset: const Offset(0, 2),
                            ),
                          ],
                        ),
                        child: Text(
                          localizations?.send ?? 'Фиристодан',
                          style: const TextStyle(
                            color: Colors.white,
                            fontWeight: FontWeight.bold,
                            fontSize: 13,
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              ],
            );
          },
        );
      },
    );
  }

  void _startTimerTask(TaskModel task) {
    // Navigate to Child Timer Screen (flat route)
    context.go(
      RoutePaths.childTimer,
      extra: {
        'taskId': task.id,
        'title': task.title,
        'duration': task.timerDurationSeconds ?? 1200,
      },
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
    final taskRepo = ref.read(taskRepositoryProvider);

    final String txtMarkDone = localizations?.markDone ?? 'Иҷро шуд';
    final String txtStartTimer = localizations?.startTimer ?? 'Оғози таймер';

    return Container(
      decoration: const BoxDecoration(
        gradient: AppColors.childBgGradient,
      ),
      child: Scaffold(
        backgroundColor: Colors.transparent,
        appBar: AppBar(
          backgroundColor: Colors.transparent,
          elevation: 0,
          title: Text(localizations?.myTasks ?? 'Вазифаҳои Ман'),
          leading: IconButton(
            icon: const Icon(Icons.arrow_back_ios_new_rounded),
            onPressed: () => context.go(RoutePaths.childDashboard),
          ),
        ),
        body: SafeArea(
          child: Column(
          children: [
            // Custom TabBar
            Container(
              color: Colors.white,
              child: TabBar(
                controller: _tabController,
                indicatorColor: AppColors.accent,
                labelColor: AppColors.accentDark,
                unselectedLabelColor: AppColors.textSecondaryLight,
                labelStyle: const TextStyle(fontWeight: FontWeight.bold, fontSize: 14),
                tabs: const [
                  Tab(text: 'Супоришҳо'),
                  Tab(text: 'Назорат'),
                  Tab(text: 'Иҷрошуда'),
                ],
              ),
            ),

            // TabBarView
            Expanded(
              child: FutureBuilder<List<TaskModel>>(
                key: ValueKey('${child.id}_$_isReloading'),
                future: taskRepo.fetchTasksForChild(child.id),
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return const Center(child: CircularProgressIndicator(color: AppColors.accent));
                  }

                  final tasks = snapshot.data ?? [];

                  final todoTasks = tasks.where((t) => t.status == 'todo' || t.status == 'in_progress').toList();
                  final pendingTasks = tasks.where((t) => t.status == 'done_pending_approval').toList();
                  final completedTasks = tasks.where((t) => t.status == 'completed').toList();

                  return TabBarView(
                    controller: _tabController,
                    children: [
                      _buildTaskList(todoTasks, 'Ягон вазифаи фаъол нест! Озодӣ! 🎈', child, txtMarkDone, txtStartTimer),
                      _buildTaskList(pendingTasks, 'Ягон вазифа дар назорат нест.', child, txtMarkDone, txtStartTimer),
                      _buildTaskList(completedTasks, 'Ҳанӯз ягон вазифаро иҷро накардаӣ. Кӯшиш кун! 💪', child, txtMarkDone, txtStartTimer),
                    ],
                  );
                },
              ),
            ),
          ],
        ),
      ),
    ),
  );
}

  Widget _buildTaskList(
    List<TaskModel> tasks,
    String emptyMessage,
    UserProfile child,
    String txtMarkDone,
    String txtStartTimer,
  ) {
    if (tasks.isEmpty) {
      return Center(
        child: Padding(
          padding: const EdgeInsets.all(AppSizes.xl),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              const Icon(Icons.mood_rounded, size: 56, color: AppColors.accent),
              const SizedBox(height: AppSizes.m),
              Text(
                emptyMessage,
                textAlign: TextAlign.center,
                style: const TextStyle(color: AppColors.textSecondaryLight, fontWeight: FontWeight.w600),
              ),
            ],
          ),
        ),
      );
    }

    return ListView.separated(
      padding: const EdgeInsets.all(AppSizes.l),
      itemCount: tasks.length,
      separatorBuilder: (_, __) => AppSizes.spaceL,
      itemBuilder: (context, index) {
        final task = tasks[index];
        return _buildTaskCard(context, task, child, txtMarkDone, txtStartTimer);
      },
    );
  }

  Widget _buildTaskCard(
    BuildContext context,
    TaskModel task,
    UserProfile child,
    String txtMarkDone,
    String txtStartTimer,
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
                      const SizedBox(height: 8),
                      // Meta Badge
                      if (task.taskType == 'timer_lock' && task.timerDurationSeconds != null)
                        _buildMetaBadge('⏳ ${(task.timerDurationSeconds! / 60).toInt()} дақиқа', Colors.purple.shade50, Colors.purple.shade800)
                      else if (task.taskType == 'deadline' && task.deadline != null)
                        _buildMetaBadge(
                          '📅 Муҳлат: ${task.deadline!.day}/${task.deadline!.month} ${task.deadline!.hour.toString().padLeft(2, '0')}:${task.deadline!.minute.toString().padLeft(2, '0')}',
                          Colors.orange.shade50,
                          Colors.orange.shade800,
                        )
                      else
                        _buildMetaBadge(typeLabel, typeColor.withOpacity(0.06), typeColor),
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

          // Interactivity section based on Task Status
          if (task.status == 'done_pending_approval') ...[
            const Divider(height: 1, color: AppColors.borderLight),
            Container(
              padding: const EdgeInsets.symmetric(horizontal: AppSizes.l, vertical: 12),
              color: Colors.orange.shade50.withOpacity(0.5),
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
            const Divider(height: 1, color: AppColors.borderLight),
            Container(
              padding: const EdgeInsets.symmetric(horizontal: AppSizes.l, vertical: 12),
              color: Colors.green.shade50.withOpacity(0.5),
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
            const Divider(height: 1, color: AppColors.borderLight),
            Container(
              padding: const EdgeInsets.symmetric(horizontal: AppSizes.l, vertical: 12),
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
                            const Icon(Icons.play_arrow_rounded, color: Colors.white, size: 16),
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
                        color: Colors.green,
                        borderRadius: BorderRadius.circular(8),
                        boxShadow: [
                          BoxShadow(
                            color: Colors.green.withOpacity(0.2),
                            blurRadius: 4,
                            offset: const Offset(0, 2),
                          ),
                        ],
                      ),
                      child: Row(
                        mainAxisSize: MainAxisSize.min,
                        children: [
                          const Icon(Icons.check_circle_rounded, color: Colors.white, size: 16),
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

  Widget _buildMetaBadge(String text, Color bgColor, Color textColor) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 2),
      decoration: BoxDecoration(
        color: bgColor,
        borderRadius: AppSizes.borderRadiusPill,
      ),
      child: Text(
        text,
        style: TextStyle(
          fontSize: 11,
          fontWeight: FontWeight.bold,
          color: textColor,
        ),
      ),
    );
  }
}
