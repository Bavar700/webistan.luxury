import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:ofarin/l10n/app_localizations.dart';
import '../../../constants/app_colors.dart';
import '../../../constants/app_sizes.dart';
import '../../auth/data/auth_repository.dart';

class AddChildDialog extends ConsumerStatefulWidget {
  final String parentId;
  final VoidCallback onChildAdded;

  const AddChildDialog({
    super.key,
    required this.parentId,
    required this.onChildAdded,
  });

  @override
  ConsumerState<AddChildDialog> createState() => _AddChildDialogState();
}

class _AddChildDialogState extends ConsumerState<AddChildDialog> {
  final _formKey = GlobalKey<FormState>();
  final _nameController = TextEditingController();
  
  // Custom animal avatars list
  final List<Map<String, dynamic>> _avatars = [
    {'emoji': '🦊', 'color': const Color(0xFFFFEDD5)}, // Orange
    {'emoji': '🦁', 'color': const Color(0xFFFEF9C3)}, // Yellow
    {'emoji': '🐼', 'color': const Color(0xFFE2E8F0)}, // Slate Grey
    {'emoji': '🦄', 'color': const Color(0xFFF3E8FF)}, // Violet
    {'emoji': '🐯', 'color': const Color(0xFFFFE4E6)}, // Red-pink
    {'emoji': '🐨', 'color': const Color(0xFFE0F2FE)}, // Light Blue
  ];

  int _selectedAvatarIndex = 0;
  bool _isLoading = false;

  @override
  void dispose() {
    _nameController.dispose();
    super.dispose();
  }

  void _submit() async {
    if (!_formKey.currentState!.validate()) return;

    setState(() {
      _isLoading = true;
    });

    try {
      final authRepo = ref.read(authRepositoryProvider);
      final selectedAvatar = _avatars[_selectedAvatarIndex]['emoji'] as String;

      await authRepo.createChildProfile(
        widget.parentId,
        _nameController.text.trim(),
        avatarUrl: selectedAvatar,
      );

      if (mounted) {
        widget.onChildAdded();
        Navigator.pop(context);
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Хатогӣ ҳангоми иловаи кӯдак: $e'),
            backgroundColor: AppColors.error,
          ),
        );
      }
    } finally {
      if (mounted) {
        setState(() {
          _isLoading = false;
        });
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    final localizations = AppLocalizations.of(context);
    final String txtAddChild = localizations?.addChild ?? 'Иловаи Кӯдак / Add Child';
    final String txtNameLabel = localizations?.childName ?? 'Номи кӯдак';
    final String txtNameHint = localizations?.enterChildName ?? 'Номи кӯдакро ворид кунед';
    final String txtChooseAvatar = localizations?.chooseAvatar ?? 'Интихоби расм';
    final String txtSave = localizations?.save ?? 'Сабт кардан';
    final String txtCancel = localizations?.cancel ?? 'Баргаштан';

    return Dialog(
      shape: RoundedRectangleBorder(borderRadius: AppSizes.borderRadiusL),
      backgroundColor: Colors.white,
      child: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(AppSizes.xl),
          child: Form(
            key: _formKey,
            child: Column(
              mainAxisSize: MainAxisSize.min,
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                // Title
                Text(
                  txtAddChild,
                  textAlign: TextAlign.center,
                  style: const TextStyle(
                    fontSize: 20,
                    fontWeight: FontWeight.bold,
                    color: AppColors.textPrimaryLight,
                  ),
                ),
                AppSizes.spaceL,

                // Name Input
                TextFormField(
                  controller: _nameController,
                  autofocus: true,
                  keyboardType: TextInputType.name,
                  decoration: InputDecoration(
                    labelText: txtNameLabel,
                    hintText: txtNameHint,
                    prefixIcon: const Icon(Icons.badge_outlined),
                  ),
                  validator: (value) {
                    if (value == null || value.trim().isEmpty) {
                      return 'Илтимос, номи кӯдакро нависед';
                    }
                    return null;
                  },
                ),
                AppSizes.spaceL,

                // Avatar Choice Heading
                Text(
                  txtChooseAvatar,
                  style: const TextStyle(
                    fontSize: 14,
                    fontWeight: FontWeight.w700,
                    color: AppColors.textSecondaryLight,
                  ),
                ),
                const SizedBox(height: AppSizes.s),

                // Horizontal avatars selector row
                SizedBox(
                  height: 64,
                  child: ListView.separated(
                    scrollDirection: Axis.horizontal,
                    itemCount: _avatars.length,
                    separatorBuilder: (_, __) => AppSizes.spaceM,
                    itemBuilder: (context, index) {
                      final avatar = _avatars[index];
                      final isSelected = index == _selectedAvatarIndex;
                      
                      return InkWell(
                        onTap: () => setState(() => _selectedAvatarIndex = index),
                        borderRadius: BorderRadius.circular(32),
                        child: AnimatedContainer(
                          duration: const Duration(milliseconds: 150),
                          width: 56,
                          height: 56,
                          decoration: BoxDecoration(
                            color: avatar['color'] as Color,
                            shape: BoxShape.circle,
                            border: Border.all(
                              color: isSelected ? AppColors.primary : Colors.transparent,
                              width: 3,
                            ),
                            boxShadow: isSelected
                                ? [
                                    BoxShadow(
                                      color: AppColors.primary.withOpacity(0.3),
                                      blurRadius: 8,
                                      offset: const Offset(0, 2),
                                    )
                                  ]
                                : [],
                          ),
                          alignment: Alignment.center,
                          child: Text(
                            avatar['emoji'] as String,
                            style: const TextStyle(fontSize: 28),
                          ),
                        ),
                      );
                    },
                  ),
                ),
                AppSizes.spaceXL,

                // Action Buttons
                Row(
                  children: [
                    Expanded(
                      child: OutlinedButton(
                        onPressed: _isLoading ? null : () => Navigator.pop(context),
                        style: OutlinedButton.styleFrom(
                          minimumSize: const Size.fromHeight(48),
                          side: const BorderSide(color: AppColors.borderLight, width: 1.5),
                          shape: RoundedRectangleBorder(
                            borderRadius: AppSizes.borderRadiusM,
                          ),
                        ),
                        child: Text(
                          txtCancel,
                          style: const TextStyle(
                            color: AppColors.textSecondaryLight,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ),
                    ),
                    const SizedBox(width: AppSizes.m),
                    Expanded(
                      child: Container(
                        height: 48,
                        decoration: BoxDecoration(
                          gradient: AppColors.primaryGradient,
                          borderRadius: AppSizes.borderRadiusM,
                        ),
                        child: ElevatedButton(
                          onPressed: _isLoading ? null : _submit,
                          style: ElevatedButton.styleFrom(
                            backgroundColor: Colors.transparent,
                            shadowColor: Colors.transparent,
                            minimumSize: const Size.fromHeight(48),
                            elevation: 0,
                          ),
                          child: _isLoading
                              ? const SizedBox(
                                  width: 20,
                                  height: 20,
                                  child: CircularProgressIndicator(
                                    color: Colors.white,
                                    strokeWidth: 2,
                                  ),
                                )
                              : Text(
                                  txtSave,
                                  style: const TextStyle(
                                    fontWeight: FontWeight.bold,
                                    color: Colors.white,
                                  ),
                                ),
                        ),
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
