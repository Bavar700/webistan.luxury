import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:ofarin/l10n/app_localizations.dart';
import '../../../constants/app_colors.dart';
import '../../../constants/app_sizes.dart';
import '../../../routing/route_constants.dart';
import '../../auth/data/auth_repository.dart';
import '../../auth/domain/auth_state.dart';
import '../../economy/data/economy_repository.dart';
import 'package:confetti/confetti.dart';

class ParentWishlistApprovalScreen extends ConsumerStatefulWidget {
  const ParentWishlistApprovalScreen({super.key});

  @override
  ConsumerState<ParentWishlistApprovalScreen> createState() => _ParentWishlistApprovalScreenState();
}

class _ParentWishlistApprovalScreenState extends ConsumerState<ParentWishlistApprovalScreen> {
  UserProfile? _selectedChild;
  bool _isReloading = false;
  late ConfettiController _confettiController;

  @override
  void initState() {
    super.initState();
    _confettiController = ConfettiController(duration: const Duration(seconds: 3));
  }

  @override
  void dispose() {
    _confettiController.dispose();
    super.dispose();
  }

  void _reloadWishlist() {
    setState(() {
      _isReloading = !_isReloading;
    });
  }

  void _approvePurchase(WishlistItemModel wish) async {
    if (_selectedChild == null) return;
    
    final economyRepo = ref.read(economyRepositoryProvider);
    try {
      await economyRepo.approveWishlistPurchase(
        wish.id,
        _selectedChild!.id,
        wish.costAmount,
        wish.currencyType,
        wish.title,
      );
      _reloadWishlist();
      _confettiController.play();
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Хариди "${wish.title}" тасдиқ шуд! Маблағ аз тавозуни кӯдак кам карда шуд.'),
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

  void _rejectRequest(WishlistItemModel wish) async {
    final economyRepo = ref.read(economyRepositoryProvider);
    try {
      await economyRepo.rejectWishlistItem(wish.id);
      _reloadWishlist();
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Дархости харид барои "${wish.title}" рад шуд.'),
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

  @override
  Widget build(BuildContext context) {
    final authState = ref.watch(authStateProvider);
    final localizations = AppLocalizations.of(context);

    if (authState is! AuthAuthenticated) {
      return const Scaffold(body: Center(child: CircularProgressIndicator()));
    }

    final parent = authState.profile;
    final authRepo = ref.read(authRepositoryProvider);
    final economyRepo = ref.read(economyRepositoryProvider);

    final String txtApprove = localizations?.approve ?? 'Тасдиқ';
    final String txtReject = localizations?.reject ?? 'Рад кардан';

    return Scaffold(
      backgroundColor: AppColors.bgLight,
      appBar: AppBar(
        title: const Text('Тасдиқи Орзуҳо'),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios_new_rounded),
          onPressed: () => context.go(RoutePaths.parentDashboard),
        ),
      ),
      body: Stack(
        alignment: Alignment.topCenter,
        children: [
          SafeArea(
            child: FutureBuilder<List<UserProfile>>(
              future: authRepo.fetchChildren(parent.id),
              builder: (context, childSnapshot) {
                if (childSnapshot.connectionState == ConnectionState.waiting) {
                  return const Center(child: CircularProgressIndicator(color: AppColors.primary));
                }

                final children = childSnapshot.data ?? [];
                if (children.isEmpty) {
                  return _buildNoChildrenState(context);
                }

                _selectedChild ??= children.first;

                return Column(
                  crossAxisAlignment: CrossAxisAlignment.stretch,
                  children: [
                    // 1. Child Selection Dropdown Header
                    _buildChildSelector(children),

                    // 2. Wishlist items FutureBuilder
                    Expanded(
                      child: FutureBuilder<List<WishlistItemModel>>(
                        key: ValueKey('${_selectedChild!.id}_$_isReloading'),
                        future: economyRepo.fetchWishlistForChild(_selectedChild!.id),
                        builder: (context, wishSnapshot) {
                          if (wishSnapshot.connectionState == ConnectionState.waiting) {
                            return const Center(child: CircularProgressIndicator(color: AppColors.primary));
                          }

                          final items = wishSnapshot.data ?? [];
                          final pendingApprovals = items.where((w) => w.status == 'approved').toList();
                          final savedList = items.where((w) => w.status == 'pending').toList();
                          final completedList = items.where((w) => w.status == 'paid').toList();

                          return ListView(
                            padding: const EdgeInsets.all(AppSizes.l),
                            children: [
                              // Section: Payout Requests
                              _buildSectionTitle('Дархостҳои харид (Payout Requests)', pendingApprovals.length),
                              AppSizes.spaceM,
                              _buildRequestsList(pendingApprovals, 'Ягон дархости фаъол нест', txtApprove, txtReject),
                              AppSizes.spaceXL,

                              // Section: Goals in Progress
                              _buildSectionTitle('Орзуҳои фаъол (Savings Goals)', savedList.length),
                              AppSizes.spaceM,
                              _buildSavingGoalsList(savedList),
                              AppSizes.spaceXL,

                              // Section: Purchase History
                              _buildSectionTitle('Таърихи харидҳо (Purchases)', completedList.length),
                              AppSizes.spaceM,
                              _buildHistoryList(completedList),
                            ],
                          );
                        },
                      ),
                    ),
                  ],
                );
              },
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
            'Орзуҳои:',
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

  Widget _buildSectionTitle(String title, int count) {
    return Row(
      children: [
        Text(
          title,
          style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 15, color: AppColors.textPrimaryLight),
        ),
        const SizedBox(width: 8),
        Container(
          padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 2),
          decoration: BoxDecoration(
            color: AppColors.borderLight,
            borderRadius: AppSizes.borderRadiusPill,
          ),
          child: Text(
            '$count',
            style: const TextStyle(fontSize: 11, fontWeight: FontWeight.bold, color: AppColors.textSecondaryLight),
          ),
        ),
      ],
    );
  }

  Widget _buildRequestsList(List<WishlistItemModel> items, String emptyMsg, String txtApprove, String txtReject) {
    if (items.isEmpty) {
      return _buildEmptyBox(emptyMsg);
    }

    return Column(
      children: items.map((wish) {
        return Container(
          margin: const EdgeInsets.only(bottom: AppSizes.m),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: AppSizes.borderRadiusM,
            border: Border.all(color: AppColors.borderLight, width: 1.2),
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              ListTile(
                contentPadding: const EdgeInsets.all(AppSizes.l),
                leading: Container(
                  width: 44,
                  height: 44,
                  decoration: BoxDecoration(color: Colors.amber.shade50, shape: BoxShape.circle),
                  child: const Icon(Icons.card_giftcard_rounded, color: Colors.orange, size: 24),
                ),
                title: Text(wish.title, style: const TextStyle(fontWeight: FontWeight.bold)),
                subtitle: wish.description != null ? Text(wish.description!) : null,
                trailing: Row(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Text(
                      '${wish.costAmount.toInt()}',
                      style: TextStyle(
                        fontSize: 18,
                        fontWeight: FontWeight.bold,
                        color: wish.currencyType == 'stars' ? AppColors.accentDark : AppColors.success,
                      ),
                    ),
                    const SizedBox(width: 2),
                    Icon(
                      wish.currencyType == 'stars' ? Icons.star_rounded : Icons.account_balance_wallet_rounded,
                      color: wish.currencyType == 'stars' ? AppColors.accent : AppColors.success,
                      size: 20,
                    ),
                  ],
                ),
              ),
              const Divider(height: 1, color: AppColors.borderLight),
              Container(
                padding: const EdgeInsets.symmetric(horizontal: AppSizes.l, vertical: AppSizes.s),
                color: const Color(0xFFFBFBFB),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.end,
                  children: [
                    OutlinedButton(
                      onPressed: () => _rejectRequest(wish),
                      style: OutlinedButton.styleFrom(
                        foregroundColor: AppColors.error,
                        side: const BorderSide(color: AppColors.error),
                        padding: const EdgeInsets.symmetric(horizontal: 16),
                      ),
                      child: Text(txtReject),
                    ),
                    const SizedBox(width: AppSizes.m),
                    ElevatedButton(
                      onPressed: () => _approvePurchase(wish),
                      style: ElevatedButton.styleFrom(
                        backgroundColor: AppColors.success,
                        foregroundColor: Colors.white,
                        elevation: 0,
                        padding: const EdgeInsets.symmetric(horizontal: 16),
                      ),
                      child: Text(txtApprove),
                    ),
                  ],
                ),
              ),
            ],
          ),
        );
      }).toList(),
    );
  }

  Widget _buildSavingGoalsList(List<WishlistItemModel> items) {
    if (items.isEmpty) {
      return _buildEmptyBox('Ягон орзу илова нашудааст.');
    }

    return Column(
      children: items.map((wish) {
        final double childBalance = wish.currencyType == 'stars' 
            ? _selectedChild!.starsBalance.toDouble() 
            : _selectedChild!.fiatBalance;
        final double progress = (childBalance / wish.costAmount).clamp(0.0, 1.0);

        return Container(
          margin: const EdgeInsets.only(bottom: AppSizes.m),
          padding: const EdgeInsets.all(AppSizes.l),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: AppSizes.borderRadiusM,
            border: Border.all(color: AppColors.borderLight, width: 1.2),
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text(wish.title, style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 15)),
                  Row(
                    children: [
                      Text(
                        '${wish.costAmount.toInt()}',
                        style: TextStyle(
                          fontSize: 16,
                          fontWeight: FontWeight.bold,
                          color: wish.currencyType == 'stars' ? AppColors.accentDark : AppColors.success,
                        ),
                      ),
                      const SizedBox(width: 2),
                      Icon(
                        wish.currencyType == 'stars' ? Icons.star_rounded : Icons.account_balance_wallet_rounded,
                        color: wish.currencyType == 'stars' ? AppColors.accent : AppColors.success,
                        size: 16,
                      ),
                    ],
                  ),
                ],
              ),
              const SizedBox(height: 10),
              ClipRRect(
                borderRadius: AppSizes.borderRadiusPill,
                child: LinearProgressIndicator(
                  value: progress,
                  minHeight: 8,
                  backgroundColor: AppColors.bgLight,
                  color: progress >= 1.0 ? AppColors.success : AppColors.accent,
                ),
              ),
              const SizedBox(height: 6),
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text(
                    'Тавозуни кӯдак: ${childBalance.toInt()} / ${wish.costAmount.toInt()}',
                    style: const TextStyle(fontSize: 11, color: AppColors.textSecondaryLight),
                  ),
                  Text(
                    '${(progress * 100).toInt()}%',
                    style: TextStyle(
                      fontSize: 11,
                      fontWeight: FontWeight.bold,
                      color: progress >= 1.0 ? AppColors.success : AppColors.accentDark,
                    ),
                  ),
                ],
              ),
            ],
          ),
        );
      }).toList(),
    );
  }

  Widget _buildHistoryList(List<WishlistItemModel> items) {
    if (items.isEmpty) {
      return _buildEmptyBox('Ҳанӯз хариде анҷом наёфтааст.');
    }

    return Column(
      children: items.map((wish) {
        return Card(
          margin: const EdgeInsets.only(bottom: AppSizes.m),
          child: ListTile(
            leading: const CircleAvatar(
              backgroundColor: Color(0xFFE8F5E9),
              child: Icon(Icons.check, color: AppColors.success),
            ),
            title: Text(wish.title, style: const TextStyle(fontWeight: FontWeight.bold, decoration: TextDecoration.lineThrough)),
            subtitle: const Text('Супорида шуд (Delivered)', style: TextStyle(color: AppColors.success, fontSize: 11, fontWeight: FontWeight.bold)),
            trailing: Row(
              mainAxisSize: MainAxisSize.min,
              children: [
                Text(
                  '-${wish.costAmount.toInt()}',
                  style: const TextStyle(fontSize: 15, fontWeight: FontWeight.bold, color: AppColors.error),
                ),
                const SizedBox(width: 2),
                Icon(
                  wish.currencyType == 'stars' ? Icons.star_rounded : Icons.account_balance_wallet_rounded,
                  color: AppColors.borderDark,
                  size: 16,
                ),
              ],
            ),
          ),
        );
      }).toList(),
    );
  }

  Widget _buildEmptyBox(String msg) {
    return Container(
      padding: const EdgeInsets.symmetric(vertical: 24, horizontal: 16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: AppSizes.borderRadiusM,
        border: Border.all(color: AppColors.borderLight, width: 1),
      ),
      alignment: Alignment.center,
      child: Text(
        msg,
        style: const TextStyle(color: AppColors.textSecondaryLight, fontSize: 13, fontWeight: FontWeight.w600),
      ),
    );
  }

  Widget _buildNoChildrenState(BuildContext context) {
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
