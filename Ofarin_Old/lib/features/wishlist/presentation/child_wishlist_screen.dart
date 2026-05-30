import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:ofarin/l10n/app_localizations.dart';
import '../../../constants/app_colors.dart';
import '../../../constants/app_sizes.dart';
import '../../../routing/route_constants.dart';
import '../../auth/data/auth_repository.dart';
import '../../economy/data/economy_repository.dart';

class ChildWishlistScreen extends ConsumerStatefulWidget {
  const ChildWishlistScreen({super.key});

  @override
  ConsumerState<ChildWishlistScreen> createState() => _ChildWishlistScreenState();
}

class _ChildWishlistScreenState extends ConsumerState<ChildWishlistScreen> {
  bool _isReloading = false;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      ref.read(appModeProvider.notifier).refreshActiveChild();
    });
  }

  void _reloadWishlist() {
    setState(() {
      _isReloading = !_isReloading;
    });
  }

  void _openAddWishDialog(BuildContext context, String childId) {
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (context) => _AddWishDialog(
        childId: childId,
        onWishAdded: _reloadWishlist,
      ),
    );
  }

  void _requestPurchase(WishlistItemModel wish) async {
    final economyRepo = ref.read(economyRepositoryProvider);
    try {
      await economyRepo.requestWishlistPayout(wish.id);
      _reloadWishlist();
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Дархост барои харидани "${wish.title}" ба волидайн фиристода шуд! 🎁'),
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
              const Text('Профил интихоб нашудааст',
                  style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold)),
              const SizedBox(height: 16),
              ElevatedButton(
                onPressed: () => context.go(RoutePaths.modeSelection),
                child: const Text('Интихоби Профил'),
              ),
            ],
          ),
        ),
      );
    }

    final child = appModeState.activeChild!;
    final economyRepo = ref.read(economyRepositoryProvider);

    final String txtWishlist = localizations?.wishlist ?? 'Рӯйхати орзуҳо';
    final String txtAddWish = localizations?.addWish ?? 'Иловаи орзу';

    return Scaffold(
      backgroundColor: AppColors.bgLight,
      appBar: AppBar(
        title: Text(txtWishlist),
        backgroundColor: AppColors.bgLight,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios_new_rounded),
          onPressed: () => context.go(RoutePaths.childDashboard),
        ),
      ),
      body: SafeArea(
        child: FutureBuilder<List<WishlistItemModel>>(
          key: ValueKey('${child.id}_$_isReloading'),
          future: economyRepo.fetchWishlistForChild(child.id),
          builder: (context, snapshot) {
            if (snapshot.connectionState == ConnectionState.waiting) {
              return const Center(child: CircularProgressIndicator(color: AppColors.accent));
            }

            final wishlist = snapshot.data ?? [];
            if (wishlist.isEmpty) {
              return Center(
                child: Padding(
                  padding: const EdgeInsets.all(AppSizes.xl),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      const Icon(Icons.card_giftcard_rounded, size: 64, color: AppColors.textSecondaryDark),
                      AppSizes.spaceM,
                      const Text(
                        'Рӯйхати орзуҳо холӣ аст.\nОрзуҳои худро илова кунед! 🌟',
                        textAlign: TextAlign.center,
                        style: TextStyle(color: AppColors.textSecondaryLight, fontWeight: FontWeight.w600),
                      ),
                      AppSizes.spaceL,
                      ElevatedButton(
                        onPressed: () => _openAddWishDialog(context, child.id),
                        child: Text(txtAddWish),
                      ),
                    ],
                  ),
                ),
              );
            }

            return GridView.builder(
              padding: const EdgeInsets.all(AppSizes.l),
              gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
                crossAxisCount: 1, // Single column list for clear progress bars
                mainAxisExtent: 180,
                mainAxisSpacing: AppSizes.l,
              ),
              itemCount: wishlist.length,
              itemBuilder: (context, index) {
                final wish = wishlist[index];
                
                // Calculate progress percentage
                final double currentBalance = wish.currencyType == 'stars' 
                    ? child.starsBalance.toDouble() 
                    : child.fiatBalance;
                final double progressPercent = (currentBalance / wish.costAmount).clamp(0.0, 1.0);
                final bool canAfford = currentBalance >= wish.costAmount;

                return _buildWishCard(wish, progressPercent, canAfford, currentBalance);
              },
            );
          },
        ),
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () => _openAddWishDialog(context, child.id),
        backgroundColor: AppColors.accent,
        child: const Icon(Icons.card_giftcard_rounded, color: Colors.white),
      ),
    );
  }

  Widget _buildWishCard(WishlistItemModel wish, double progressPercent, bool canAfford, double currentBalance) {
    final int displayPercent = (progressPercent * 100).toInt();

    Color statusColor;
    String statusText;
    
    if (wish.status == 'paid') {
      statusColor = AppColors.success;
      statusText = 'Харида шуд! 🎉';
    } else if (wish.status == 'approved') {
      statusColor = Colors.orange;
      statusText = 'Дар интизори харид 🎁';
    } else if (wish.status == 'rejected') {
      statusColor = AppColors.error;
      statusText = 'Рад шуд';
    } else {
      statusText = canAfford ? 'Маблағ ҷамъ шуд!' : 'Ҷамъ карда истодаам';
      statusColor = canAfford ? AppColors.success : AppColors.textSecondaryDark;
    }

    return Container(
      padding: const EdgeInsets.all(AppSizes.l),
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
          Row(
            children: [
              // Gift Icon Badge
              Container(
                width: 40,
                height: 40,
                decoration: BoxDecoration(
                  color: AppColors.accent.withOpacity(0.1),
                  shape: BoxShape.circle,
                ),
                child: const Icon(Icons.card_giftcard_rounded, color: AppColors.accentDark, size: 20),
              ),
              AppSizes.spaceL,

              // Content Details
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      wish.title,
                      style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16, color: AppColors.textPrimaryLight),
                    ),
                    if (wish.description != null) ...[
                      const SizedBox(height: 2),
                      Text(
                        wish.description!,
                        maxLines: 1,
                        overflow: TextOverflow.ellipsis,
                        style: const TextStyle(fontSize: 12, color: AppColors.textSecondaryLight),
                      ),
                    ],
                  ],
                ),
              ),

              // Price Badge
              Column(
                crossAxisAlignment: CrossAxisAlignment.end,
                children: [
                  Row(
                    children: [
                      Text(
                        '${wish.costAmount.toInt()}',
                        style: TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.w900,
                          color: wish.currencyType == 'stars' ? AppColors.accentDark : AppColors.success,
                        ),
                      ),
                      const SizedBox(width: 2),
                      Icon(
                        wish.currencyType == 'stars' ? Icons.star_rounded : Icons.account_balance_wallet_rounded,
                        color: wish.currencyType == 'stars' ? AppColors.accent : AppColors.success,
                        size: 18,
                      ),
                    ],
                  ),
                ],
              ),
            ],
          ),
          
          const SizedBox(height: 8),

          // Savings Linear Progress Bar
          if (wish.status == 'pending') ...[
            ClipRRect(
              borderRadius: AppSizes.borderRadiusPill,
              child: LinearProgressIndicator(
                value: progressPercent,
                minHeight: 10,
                backgroundColor: AppColors.bgLight,
                color: canAfford ? AppColors.success : AppColors.accent,
              ),
            ),
            const SizedBox(height: 6),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  'Баланси ман: ${currentBalance.toInt()} / ${wish.costAmount.toInt()}',
                  style: const TextStyle(fontSize: 11, color: AppColors.textSecondaryLight),
                ),
                Text(
                  '$displayPercent%',
                  style: TextStyle(
                    fontSize: 11, 
                    fontWeight: FontWeight.bold, 
                    color: canAfford ? AppColors.success : AppColors.accentDark,
                  ),
                ),
              ],
            ),
          ],

          // Footer Action / Status Banner
          if (wish.status == 'pending') ...[
            if (canAfford)
              ElevatedButton.icon(
                onPressed: () => _requestPurchase(wish),
                icon: const Icon(Icons.send_rounded, size: 14),
                label: const Text('Дархости харид аз волидайн'),
                style: ElevatedButton.styleFrom(
                  backgroundColor: AppColors.accent,
                  foregroundColor: Colors.white,
                  minimumSize: const Size.fromHeight(36),
                  elevation: 0,
                  shape: RoundedRectangleBorder(borderRadius: AppSizes.borderRadiusS),
                ),
              )
            else
              Align(
                alignment: Alignment.centerRight,
                child: Text(
                  statusText,
                  style: TextStyle(fontWeight: FontWeight.bold, fontSize: 12, color: statusColor),
                ),
              ),
          ] else ...[
            Container(
              padding: const EdgeInsets.symmetric(vertical: 8),
              decoration: BoxDecoration(
                color: statusColor.withOpacity(0.08),
                borderRadius: AppSizes.borderRadiusS,
              ),
              alignment: Alignment.center,
              child: Text(
                statusText,
                style: TextStyle(fontWeight: FontWeight.bold, fontSize: 13, color: statusColor),
              ),
            ),
          ],
        ],
      ),
    );
  }
}

// Add Wish Dialog Widget (Private Helper)
class _AddWishDialog extends ConsumerStatefulWidget {
  final String childId;
  final VoidCallback onWishAdded;

  const _AddWishDialog({
    required this.childId,
    required this.onWishAdded,
  });

  @override
  ConsumerState<_AddWishDialog> createState() => _AddWishDialogState();
}

class _AddWishDialogState extends ConsumerState<_AddWishDialog> {
  final _formKey = GlobalKey<FormState>();
  final _titleController = TextEditingController();
  final _descController = TextEditingController();
  final _costController = TextEditingController(text: '30');
  
  String _currencyType = 'stars';
  bool _isLoading = false;

  @override
  void dispose() {
    _titleController.dispose();
    _descController.dispose();
    _costController.dispose();
    super.dispose();
  }

  void _submit() async {
    if (!_formKey.currentState!.validate()) return;

    setState(() {
      _isLoading = true;
    });

    try {
      final economyRepo = ref.read(economyRepositoryProvider);
      
      final wish = WishlistItemModel(
        id: '',
        childId: widget.childId,
        title: _titleController.text.trim(),
        description: _descController.text.trim().isEmpty ? null : _descController.text.trim(),
        costAmount: double.tryParse(_costController.text) ?? 10.0,
        currencyType: _currencyType,
        status: 'pending',
        createdAt: DateTime.now(),
      );

      await economyRepo.createWishlistItem(wish);

      if (mounted) {
        widget.onWishAdded();
        Navigator.pop(context);
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Хатогӣ: $e'), backgroundColor: AppColors.error),
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
    final String txtAddWish = localizations?.addWish ?? 'Иловаи орзу';
    final String txtCost = localizations?.goalCost ?? 'Арзиш';
    final String txtSave = localizations?.save ?? 'Сабт';
    final String txtCancel = localizations?.cancel ?? 'Баргаштан';

    return Dialog(
      shape: RoundedRectangleBorder(borderRadius: AppSizes.borderRadiusL),
      child: Padding(
        padding: const EdgeInsets.all(AppSizes.xl),
        child: Form(
          key: _formKey,
          child: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              Text(
                txtAddWish,
                textAlign: TextAlign.center,
                style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
              ),
              AppSizes.spaceL,

              TextFormField(
                controller: _titleController,
                decoration: const InputDecoration(
                  labelText: 'Номи орзу (Масалан: Велосипед)',
                  prefixIcon: Icon(Icons.card_giftcard_rounded),
                ),
                validator: (value) {
                  if (value == null || value.trim().isEmpty) return 'Илтимос, номи орзуро нависед';
                  return null;
                },
              ),
              AppSizes.spaceL,

              TextFormField(
                controller: _descController,
                decoration: const InputDecoration(
                  labelText: 'Тавсифи орзу (Ихтиёрӣ)',
                  prefixIcon: Icon(Icons.description_outlined),
                ),
              ),
              AppSizes.spaceL,

              Row(
                children: [
                  Expanded(
                    flex: 4,
                    child: DropdownButtonFormField<String>(
                      initialValue: _currencyType,
                      decoration: const InputDecoration(labelText: 'Мукофот'),
                      items: [
                        DropdownMenuItem(value: 'stars', child: Text(localizations?.stars ?? 'Ситораҳо')),
                        DropdownMenuItem(value: 'fiat', child: Text(localizations?.fiat ?? 'Сомонӣ')),
                      ],
                      onChanged: (val) {
                        if (val != null) {
                          setState(() {
                            _currencyType = val;
                            _costController.text = val == 'stars' ? '30' : '50.00';
                          });
                        }
                      },
                    ),
                  ),
                  const SizedBox(width: AppSizes.m),
                  Expanded(
                    flex: 4,
                    child: TextFormField(
                      controller: _costController,
                      keyboardType: TextInputType.number,
                      decoration: InputDecoration(labelText: txtCost),
                      validator: (value) {
                        final n = double.tryParse(value ?? '');
                        if (n == null || n <= 0.0) return 'Арзиши мусбат';
                        return null;
                      },
                    ),
                  ),
                ],
              ),
              AppSizes.spaceXL,

              Row(
                children: [
                  Expanded(
                    child: OutlinedButton(
                      onPressed: _isLoading ? null : () => Navigator.pop(context),
                      child: Text(txtCancel),
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
                          elevation: 0,
                        ),
                        child: _isLoading
                            ? const SizedBox(width: 20, height: 20, child: CircularProgressIndicator(color: Colors.white))
                            : Text(txtSave, style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
                      ),
                    ),
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }
}
