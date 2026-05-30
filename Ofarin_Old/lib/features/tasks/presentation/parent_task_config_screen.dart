import 'package:flutter/material.dart';
import 'dart:convert';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:ofarin/l10n/app_localizations.dart';
import '../../../constants/app_colors.dart';
import '../../../constants/app_sizes.dart';
import '../../../routing/route_constants.dart';
import '../../auth/data/auth_repository.dart';
import '../../auth/domain/auth_state.dart';
import '../data/task_repository.dart';
import 'package:confetti/confetti.dart';
import 'add_task_dialog.dart';

class ParentTaskConfigScreen extends ConsumerStatefulWidget {
  const ParentTaskConfigScreen({super.key});

  @override
  ConsumerState<ParentTaskConfigScreen> createState() => _ParentTaskConfigScreenState();
}

class _ParentTaskConfigScreenState extends ConsumerState<ParentTaskConfigScreen> with SingleTickerProviderStateMixin {
  late TabController _tabController;
  late ConfettiController _confettiController;
  UserProfile? _selectedChild;
  bool _isReloading = false;

  List<UserProfile>? _children;
  bool _loadingChildren = true;
  String? _childrenError;

  @override
  void initState() {
    super.initState();
    _tabController = TabController(length: 3, vsync: this);
    _confettiController = ConfettiController(duration: const Duration(seconds: 3));
    WidgetsBinding.instance.addPostFrameCallback((_) {
      _loadChildren();
    });
  }

  void _loadChildren() async {
    final authState = ref.read(authStateProvider);
    if (authState is AuthAuthenticated) {
      final parent = authState.profile;
      final authRepo = ref.read(authRepositoryProvider);
      try {
        final list = await authRepo.fetchChildren(parent.id);
        if (mounted) {
          setState(() {
            _children = list;
            _loadingChildren = false;
            if (list.isNotEmpty && _selectedChild == null) {
              _selectedChild = list.first;
            }
          });
        }
      } catch (e) {
        if (mounted) {
          setState(() {
            _childrenError = e.toString();
            _loadingChildren = false;
          });
        }
      }
    } else {
      if (mounted) {
        setState(() {
          _loadingChildren = false;
        });
      }
    }
  }

  @override
  void dispose() {
    _tabController.dispose();
    _confettiController.dispose();
    super.dispose();
  }

  void _reloadTasks() {
    setState(() {
      _isReloading = !_isReloading;
    });
  }

  void _approveTask(TaskModel task) async {
    final taskRepo = ref.read(taskRepositoryProvider);
    try {
      await taskRepo.approveTask(task.id, task.childId, task.rewardAmount, task.rewardType);
      _reloadTasks();
      _confettiController.play();
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Вазифа "${task.title}" тасдиқ шуд! Бозичаҳо ва ситораҳо зиёд шуданд.'),
            backgroundColor: AppColors.success,
            behavior: SnackBarBehavior.floating,
          ),
        );
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Хатогӣ: $e'), backgroundColor: AppColors.error),
        );
      }
    }
  }

  void _rejectTask(TaskModel task) async {
    final taskRepo = ref.read(taskRepositoryProvider);
    try {
      await taskRepo.rejectTask(task.id);
      _reloadTasks();
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Вазифа "${task.title}" рад шуд ва ба ҳолати аввала баргашт.'),
            backgroundColor: AppColors.warning,
            behavior: SnackBarBehavior.floating,
          ),
        );
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Хатогӣ: $e'), backgroundColor: AppColors.error),
        );
      }
    }
  }

  void _openAddTask(BuildContext context, String parentId) {
    if (_selectedChild == null) return;
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (context) => AddTaskDialog(
        parentId: parentId,
        childId: _selectedChild!.id,
        onTaskAdded: _reloadTasks,
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    final authState = ref.watch(authStateProvider);
    final localizations = AppLocalizations.of(context);

    if (authState is! AuthAuthenticated) {
      return const Scaffold(
        body: Center(child: CircularProgressIndicator()),
      );
    }

    final parent = authState.profile;
    final taskRepo = ref.read(taskRepositoryProvider);

    final String txtApprove = localizations?.approve ?? 'Тасдиқ';
    final String txtReject = localizations?.reject ?? 'Рад кардан';

    return Scaffold(
      backgroundColor: AppColors.bgLight,
      appBar: AppBar(
        title: const Text('Танзимоти вазифаҳо'),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios_new_rounded),
          onPressed: () => context.go(RoutePaths.parentDashboard),
        ),
      ),
      body: Stack(
        alignment: Alignment.topCenter,
        children: [
          SafeArea(
            child: _loadingChildren
                ? const Center(child: CircularProgressIndicator(color: AppColors.primary))
                : _childrenError != null
                    ? Center(
                        child: Text(
                          'Хатогӣ ҳангоми боркунии фарзандон: $_childrenError',
                          style: const TextStyle(color: AppColors.error),
                        ),
                      )
                    : (_children == null || _children!.isEmpty)
                        ? _buildNoChildrenState(context, parent.id)
                        : Column(
                            crossAxisAlignment: CrossAxisAlignment.stretch,
                            children: [
                              // 1. Child Selection Dropdown Header
                              _buildChildSelector(_children!),

                              // 2. Custom Styled TabBar
                              Container(
                                color: Colors.white,
                                child: TabBar(
                                  controller: _tabController,
                                  indicatorColor: AppColors.primary,
                                  labelColor: AppColors.primary,
                                  unselectedLabelColor: AppColors.textSecondaryLight,
                                  labelStyle: const TextStyle(fontWeight: FontWeight.bold, fontSize: 14),
                                  tabs: const [
                                    Tab(text: 'Фаъол (Active)'),
                                    Tab(text: 'Интизорӣ (Review)'),
                                    Tab(text: 'Иҷрошуда (Done)'),
                                  ],
                                ),
                              ),

                              // 3. TabBarView for Task Lists
                              if (_selectedChild != null)
                                Expanded(
                                  child: FutureBuilder<List<TaskModel>>(
                                    key: ValueKey('${_selectedChild!.id}_$_isReloading'),
                                    future: taskRepo.fetchTasksForChild(_selectedChild!.id),
                                    builder: (context, taskSnapshot) {
                                      if (taskSnapshot.connectionState == ConnectionState.waiting) {
                                        return const Center(child: CircularProgressIndicator(color: AppColors.primary));
                                      }

                                      final tasks = taskSnapshot.data ?? [];

                                      // Filter tasks for each tab
                                      final activeTasks = tasks.where((t) => t.status == 'todo' || t.status == 'in_progress').toList();
                                      final pendingTasks = tasks.where((t) => t.status == 'done_pending_approval').toList();
                                      final completedTasks = tasks.where((t) => t.status == 'completed' || t.status == 'failed').toList();

                                      return TabBarView(
                                        controller: _tabController,
                                        children: [
                                          _buildTaskList(activeTasks, 'Ягон вазифаи фаъол нест', showReviewActions: false),
                                          _buildTaskList(pendingTasks, 'Ягон дархост барои тасдиқ нест', showReviewActions: true, txtApprove: txtApprove, txtReject: txtReject),
                                          _buildTaskList(completedTasks, 'Ягон вазифаи иҷрошуда нест', showReviewActions: false),
                                        ],
                                      );
                                    },
                                  ),
                                )
                              else
                                const Expanded(
                                  child: Center(
                                    child: CircularProgressIndicator(color: AppColors.primary),
                                  ),
                                ),
                            ],
                          ),
          ),
          ConfettiWidget(
            confettiController: _confettiController,
            blastDirectionality: BlastDirectionality.explosive,
            shouldLoop: false,
            colors: const [
              Colors.green,
              Colors.blue,
              Colors.pink,
              Colors.orange,
              Colors.purple,
              Colors.yellow,
            ],
          ),
        ],
      ),
      floatingActionButton: _selectedChild != null
          ? FloatingActionButton(
              onPressed: () => _openAddTask(context, parent.id),
              backgroundColor: AppColors.primary,
              child: const Icon(Icons.add, color: Colors.white, size: 28),
            )
          : null,
    );
  }

  Widget _buildChildSelector(List<UserProfile> children) {
    return Container(
      color: Colors.white,
      padding: const EdgeInsets.symmetric(horizontal: AppSizes.l, vertical: AppSizes.s),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          const Text(
            'Супоришҳо барои:',
            style: TextStyle(fontWeight: FontWeight.bold, color: AppColors.textSecondaryLight),
          ),
          DropdownButton<UserProfile>(
            value: _selectedChild,
            icon: const Icon(Icons.arrow_drop_down_rounded, color: AppColors.primary),
            underline: Container(),
            onChanged: (UserProfile? newVal) {
              if (newVal != null) {
                setState(() {
                  _selectedChild = newVal;
                });
              }
            },
            items: children.map<DropdownMenuItem<UserProfile>>((UserProfile child) {
              return DropdownMenuItem<UserProfile>(
                value: child,
                child: Row(
                  children: [
                    Text(child.avatarUrl ?? '🦊', style: const TextStyle(fontSize: 18)),
                    const SizedBox(width: 8),
                    Text(
                      child.displayName,
                      style: const TextStyle(fontWeight: FontWeight.bold, color: AppColors.primary),
                    ),
                  ],
                ),
              );
            }).toList(),
          ),
        ],
      ),
    );
  }

  Widget _buildTaskList(
    List<TaskModel> tasks,
    String emptyMessage, {
    required bool showReviewActions,
    String? txtApprove,
    String? txtReject,
  }) {
    if (tasks.isEmpty) {
      return Center(
        child: Padding(
          padding: const EdgeInsets.all(AppSizes.xl),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              const Icon(Icons.assignment_turned_in_outlined, size: 48, color: AppColors.textSecondaryDark),
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
        return _buildTaskCard(task, showReviewActions, txtApprove, txtReject);
      },
    );
  }

  Widget _buildTaskCard(
    TaskModel task,
    bool showReviewActions,
    String? txtApprove,
    String? txtReject,
  ) {
    // Determine icon and color based on task type
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
        borderRadius: AppSizes.borderRadiusM,
        border: Border.all(color: AppColors.borderLight, width: 1.2),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.01),
            blurRadius: 10,
            offset: const Offset(0, 4),
          )
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          // Upper Info Segment
          Padding(
            padding: const EdgeInsets.all(AppSizes.l),
            child: Row(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // Task Type Icon Badge
                Container(
                  width: 44,
                  height: 44,
                  decoration: BoxDecoration(
                    color: typeColor.withOpacity(0.12),
                    borderRadius: AppSizes.borderRadiusS,
                  ),
                  child: Icon(typeIcon, color: typeColor, size: 24),
                ),
                AppSizes.spaceL,

                // Content Description
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        task.title,
                        style: const TextStyle(
                          fontSize: 16,
                          fontWeight: FontWeight.bold,
                          color: AppColors.textPrimaryLight,
                        ),
                      ),
                      if (task.description != null) ...[
                        const SizedBox(height: 4),
                        Text(
                          task.description!,
                          style: const TextStyle(
                            fontSize: 13,
                            color: AppColors.textSecondaryLight,
                          ),
                        ),
                      ],
                      const SizedBox(height: 8),
                      // Meta Information (Timer duration or Deadline date)
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
                
                // Reward Badge
                Column(
                  crossAxisAlignment: CrossAxisAlignment.end,
                  children: [
                    Row(
                      children: [
                        Text(
                          task.rewardType == 'stars' 
                              ? '+${task.rewardAmount.toInt()}' 
                              : '+${task.rewardAmount.toStringAsFixed(1)}',
                          style: TextStyle(
                            fontSize: 18,
                            fontWeight: FontWeight.bold,
                            color: task.rewardType == 'stars' ? AppColors.accentDark : AppColors.success,
                          ),
                        ),
                        const SizedBox(width: 2),
                        Icon(
                          task.rewardType == 'stars' ? Icons.star_rounded : Icons.account_balance_wallet_rounded,
                          color: task.rewardType == 'stars' ? AppColors.accent : AppColors.success,
                          size: 20,
                        ),
                      ],
                    ),
                    if (task.penaltyAmount > 0.0) ...[
                      const SizedBox(height: 2),
                      Text(
                        'Ҷарима: -${task.penaltyAmount.toInt()}',
                        style: const TextStyle(fontSize: 10, color: AppColors.error, fontWeight: FontWeight.w600),
                      ),
                    ],
                  ],
                ),
              ],
            ),
          ),

          if ((task.submissionComment != null && task.submissionComment!.isNotEmpty) ||
              (task.submissionImageUrl != null && task.submissionImageUrl!.isNotEmpty)) ...[
            const Divider(height: 1, color: AppColors.borderLight),
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: AppSizes.l, vertical: AppSizes.s),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  if (task.submissionComment != null && task.submissionComment!.isNotEmpty) ...[
                    const SizedBox(height: 4),
                    Container(
                      padding: const EdgeInsets.all(12),
                      decoration: BoxDecoration(
                        color: const Color(0xFFE3F2FD),
                        borderRadius: BorderRadius.circular(8),
                        border: Border.all(color: const Color(0xFFBBDEFB)),
                      ),
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          const Icon(Icons.comment_rounded, color: Colors.blue, size: 18),
                          const SizedBox(width: 8),
                          Expanded(
                            child: Text(
                              'Шарҳ: "${task.submissionComment}"',
                              style: const TextStyle(
                                fontSize: 13,
                                color: Color(0xFF0D47A1),
                                fontStyle: FontStyle.italic,
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),
                  ],
                  if (task.submissionImageUrl != null && task.submissionImageUrl!.isNotEmpty) ...[
                    const SizedBox(height: 8),
                    const Text(
                      'Акси замимашуда:',
                      style: TextStyle(fontSize: 12, fontWeight: FontWeight.bold, color: AppColors.textSecondaryLight),
                    ),
                    const SizedBox(height: 4),
                    Container(
                      height: 160,
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(8),
                        border: Border.all(color: Colors.grey.shade300),
                        image: DecorationImage(
                          image: (task.submissionImageUrl!.startsWith('data:image') || !task.submissionImageUrl!.startsWith('http'))
                              ? MemoryImage(base64Decode(task.submissionImageUrl!.split(',').last)) as ImageProvider
                              : NetworkImage(task.submissionImageUrl!),
                          fit: BoxFit.cover,
                        ),
                      ),
                    ),
                  ],
                ],
              ),
            ),
          ],

          // Approval Action Bar (Only for Review/Pending approvals tab)
          if (showReviewActions) ...[
            const Divider(height: 1, color: AppColors.borderLight),
            Container(
              padding: const EdgeInsets.symmetric(horizontal: AppSizes.l, vertical: AppSizes.s),
              color: const Color(0xFFFBFBFB),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.end,
                children: [
                  OutlinedButton.icon(
                    onPressed: () => _rejectTask(task),
                    icon: const Icon(Icons.close, size: 16),
                    label: Text(txtReject ?? 'Рад кардан'),
                    style: OutlinedButton.styleFrom(
                      foregroundColor: AppColors.error,
                      side: const BorderSide(color: AppColors.error, width: 1.2),
                      shape: RoundedRectangleBorder(borderRadius: AppSizes.borderRadiusS),
                      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                    ),
                  ),
                  const SizedBox(width: AppSizes.m),
                  ElevatedButton.icon(
                    onPressed: () => _approveTask(task),
                    icon: const Icon(Icons.check, size: 16),
                    label: Text(txtApprove ?? 'Тасдиқ'),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: AppColors.success,
                      foregroundColor: Colors.white,
                      elevation: 0,
                      shape: RoundedRectangleBorder(borderRadius: AppSizes.borderRadiusS),
                      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
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

  Widget _buildNoChildrenState(BuildContext context, String parentId) {
    return Center(
      child: Padding(
        padding: const EdgeInsets.all(AppSizes.xl),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const Icon(Icons.people_outline_rounded, size: 64, color: AppColors.textSecondaryDark),
            AppSizes.spaceM,
            const Text(
              'Аввал кӯдаконро дар панели асосӣ илова кунед.',
              style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold, color: AppColors.textSecondaryLight),
              textAlign: TextAlign.center,
            ),
            AppSizes.spaceL,
            ElevatedButton(
              onPressed: () => context.go(RoutePaths.parentDashboard),
              child: const Text('Баргаштан ба Панел'),
            ),
          ],
        ),
      ),
    );
  }
}
