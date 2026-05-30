// ══════════════════════════════════════════════════════════════════════════════
// Create Task Screen — Parent creates a new task for a child (real Supabase)
// ══════════════════════════════════════════════════════════════════════════════

import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:uuid/uuid.dart';
import '../../../../core/theme/app_colors.dart';
import '../../../../core/utils/snackbar_helper.dart';
import '../../data/enums/task_status.dart';
import '../../data/models/task_model.dart';
import '../providers/task_provider.dart';
import '../../../auth/presentation/providers/auth_provider.dart';

class CreateTaskScreen extends ConsumerStatefulWidget {
  const CreateTaskScreen({super.key});

  @override
  ConsumerState<CreateTaskScreen> createState() => _CreateTaskScreenState();
}

class _CreateTaskScreenState extends ConsumerState<CreateTaskScreen> {
  final _titleController = TextEditingController();
  final _descriptionController = TextEditingController();
  final _rewardController = TextEditingController(text: '1');
  final _penaltyController = TextEditingController(text: '0');
  final _timerController = TextEditingController();
  final _childIdController = TextEditingController();
  bool _isBonus = false;
  String _rewardCurrency = 'star';
  String _penaltyCurrency = 'star';
  bool _isSaving = false;

  @override
  void dispose() {
    _titleController.dispose();
    _descriptionController.dispose();
    _rewardController.dispose();
    _penaltyController.dispose();
    _timerController.dispose();
    _childIdController.dispose();
    super.dispose();
  }

  Future<void> _handleCreate() async {
    final title = _titleController.text.trim();
    final description = _descriptionController.text.trim();
    final rewardText = _rewardController.text.trim();
    final penaltyText = _penaltyController.text.trim();
    final timerText = _timerController.text.trim();
    final childId = _childIdController.text.trim();

    // Validation
    if (title.isEmpty) {
      context.showError('title_required'.tr());
      return;
    }
    if (description.isEmpty) {
      context.showError('description_required'.tr());
      return;
    }
    if (childId.isEmpty) {
      context.showError('child_id_required'.tr());
      return;
    }

    final rewardAmount = double.tryParse(rewardText) ?? 1;
    final penaltyAmount = double.tryParse(penaltyText) ?? 0;
    final timerMins = int.tryParse(timerText);

    // Get current user as parent
    final authState = ref.read(authProvider);
    final parentId = authState.user?.id ?? '';
    if (parentId.isEmpty) {
      context.showError('auth_required'.tr());
      return;
    }

    setState(() => _isSaving = true);

    final task = TaskModel(
      id: const Uuid().v4(),
      childId: childId,
      parentId: parentId,
      title: title,
      description: description,
      isBonus: _isBonus,
      timerDurationMins: timerMins,
      rewardAmount: rewardAmount,
      rewardCurrency: _rewardCurrency,
      penaltyAmount: penaltyAmount,
      penaltyCurrency: _penaltyCurrency,
      status: TaskStatus.active,
    );

    final created = await ref.read(taskProvider.notifier).createTask(task);
    setState(() => _isSaving = false);

    if (!mounted) return;

    if (created != null) {
      context.showSuccess('task_created'.tr());
      context.pop();
    } else {
      final errorState = ref.read(taskProvider);
      context.showError(errorState.error ?? 'error_creating_task'.tr());
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('create_task_title'.tr()),
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
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(20),
          child: Column(
            children: [
              // Title
              TextField(
                controller: _titleController,
                textInputAction: TextInputAction.next,
                decoration: InputDecoration(
                  labelText: 'title'.tr(),
                  hintText: 'task_title_hint'.tr(),
                ),
              ),
              const SizedBox(height: 16),
              // Description
              TextField(
                controller: _descriptionController,
                maxLines: 4,
                textInputAction: TextInputAction.next,
                decoration: InputDecoration(
                  labelText: 'description'.tr(),
                  hintText: 'description_hint'.tr(),
                ),
              ),
              const SizedBox(height: 16),
              // Child ID
              TextField(
                controller: _childIdController,
                textInputAction: TextInputAction.next,
                decoration: InputDecoration(
                  labelText: 'child_id_label'.tr(),
                  hintText: 'child_id_hint'.tr(),
                  prefixIcon: const Icon(Icons.child_care),
                ),
              ),
              const SizedBox(height: 16),
              // Reward + Currency
              Row(
                children: [
                  Expanded(
                    child: TextField(
                      controller: _rewardController,
                      keyboardType: TextInputType.number,
                      textInputAction: TextInputAction.next,
                      decoration: InputDecoration(
                        labelText: 'reward'.tr(),
                      ),
                    ),
                  ),
                  const SizedBox(width: 12),
                  Expanded(
                    child: DropdownButtonFormField<String>(
                      initialValue: _rewardCurrency,
                      items: [
                        DropdownMenuItem(value: 'star', child: Text('⭐ ${'currency_stars'.tr()}')),
                        DropdownMenuItem(value: 'gold', child: Text('🏆 ${'currency_gold'.tr()}')),
                        DropdownMenuItem(value: 'fiat', child: Text('💰 ${'currency_tjs'.tr()}')),
                      ],
                      onChanged: (v) => setState(() => _rewardCurrency = v!),
                      decoration: InputDecoration(labelText: 'currency'.tr()),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 16),
              // Penalty + Currency
              Row(
                children: [
                  Expanded(
                    child: TextField(
                      controller: _penaltyController,
                      keyboardType: TextInputType.number,
                      textInputAction: TextInputAction.next,
                      decoration: InputDecoration(
                        labelText: 'penalty'.tr(),
                      ),
                    ),
                  ),
                  const SizedBox(width: 12),
                  Expanded(
                    child: DropdownButtonFormField<String>(
                      initialValue: _penaltyCurrency,
                      items: [
                        DropdownMenuItem(value: 'star', child: Text('⭐ ${'currency_stars'.tr()}')),
                        DropdownMenuItem(value: 'gold', child: Text('🏆 ${'currency_gold'.tr()}')),
                      ],
                      onChanged: (v) => setState(() => _penaltyCurrency = v!),
                      decoration: InputDecoration(labelText: 'currency'.tr()),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 16),
              // Timer + Is Bonus
              Row(
                children: [
                  Expanded(
                    child: TextField(
                      controller: _timerController,
                      keyboardType: TextInputType.number,
                      decoration: InputDecoration(
                        labelText: 'timer_duration_min'.tr(),
                        hintText: '15',
                      ),
                    ),
                  ),
                  const SizedBox(width: 12),
                  Expanded(
                    child: SwitchListTile(
                      title: Text(
                        'bonus_task'.tr(),
                        style: const TextStyle(fontSize: 14, color: AppColors.textPrimary),
                      ),
                      value: _isBonus,
                      onChanged: (v) => setState(() => _isBonus = v),
                      contentPadding: EdgeInsets.zero,
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 24),
              // Submit button
              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: _isSaving ? null : _handleCreate,
                  child: _isSaving
                      ? const SizedBox(
                          height: 20,
                          width: 20,
                          child: CircularProgressIndicator(
                            strokeWidth: 2,
                            color: AppColors.textDark,
                          ),
                        )
                      : Text('create_task'.tr()),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
