import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:ofarin/l10n/app_localizations.dart';
import '../../../constants/app_colors.dart';
import '../../../constants/app_sizes.dart';
import '../../../routing/route_constants.dart';
import '../../auth/data/auth_repository.dart';
import '../data/economy_repository.dart';

class ChildWalletScreen extends ConsumerStatefulWidget {
  const ChildWalletScreen({super.key});

  @override
  ConsumerState<ChildWalletScreen> createState() => _ChildWalletScreenState();
}

class _ChildWalletScreenState extends ConsumerState<ChildWalletScreen> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      ref.read(appModeProvider.notifier).refreshActiveChild();
    });
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

    final String txtHistory = localizations?.transactionHistory ?? 'Таърихи ҳамён';

    return Scaffold(
      backgroundColor: AppColors.bgLight,
      appBar: AppBar(
        title: Text(txtHistory),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios_new_rounded),
          onPressed: () => context.go(RoutePaths.childDashboard),
        ),
      ),
      body: SafeArea(
        child: Column(
          children: [
            // 1. Balance Summary Card (Mini Banner)
            Container(
              margin: const EdgeInsets.all(AppSizes.l),
              padding: const EdgeInsets.all(AppSizes.l),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: AppSizes.borderRadiusM,
                border: Border.all(color: AppColors.borderLight, width: 1.5),
              ),
              child: Row(
                children: [
                  Expanded(
                    child: Column(
                      children: [
                        const Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Icon(Icons.star_rounded, color: AppColors.accent, size: 20),
                            SizedBox(width: 4),
                            Text('Ситораҳо', style: TextStyle(fontSize: 12, color: Colors.grey, fontWeight: FontWeight.bold)),
                          ],
                        ),
                        const SizedBox(height: 6),
                        Text(
                          '${child.starsBalance}',
                          style: const TextStyle(fontSize: 22, fontWeight: FontWeight.w900, color: AppColors.textPrimaryLight),
                        ),
                      ],
                    ),
                  ),
                  Container(width: 1.5, height: 40, color: AppColors.borderLight),
                  Expanded(
                    child: Column(
                      children: [
                        const Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Icon(Icons.account_balance_wallet_rounded, color: AppColors.success, size: 18),
                            SizedBox(width: 4),
                            Text('Сомонӣ', style: TextStyle(fontSize: 12, color: Colors.grey, fontWeight: FontWeight.bold)),
                          ],
                        ),
                        const SizedBox(height: 6),
                        Text(
                          child.fiatBalance.toStringAsFixed(2),
                          style: const TextStyle(fontSize: 20, fontWeight: FontWeight.w900, color: AppColors.textPrimaryLight),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),

            const Padding(
              padding: EdgeInsets.symmetric(horizontal: AppSizes.l),
              child: Align(
                alignment: Alignment.centerLeft,
                child: Text(
                  'Ҳамаи амалиётҳо (Transactions History)',
                  style: TextStyle(fontWeight: FontWeight.bold, fontSize: 14, color: AppColors.textSecondaryLight),
                ),
              ),
            ),
            const SizedBox(height: AppSizes.s),

            // 2. Transaction List
            Expanded(
              child: FutureBuilder<List<TransactionModel>>(
                future: economyRepo.fetchTransactions(child.id),
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return const Center(child: CircularProgressIndicator(color: AppColors.accent));
                  }

                  if (snapshot.hasError) {
                    return Center(
                      child: Text(
                        'Хатогӣ: ${snapshot.error}',
                        style: const TextStyle(color: AppColors.error),
                      ),
                    );
                  }

                  final txList = snapshot.data ?? [];
                  if (txList.isEmpty) {
                    return const Center(
                      child: Text(
                        'Ҳанӯз ягон амалиёт иҷро нашудааст.',
                        style: TextStyle(color: AppColors.textSecondaryLight, fontWeight: FontWeight.w600),
                      ),
                    );
                  }

                  // Sort desc (newest first)
                  txList.sort((a, b) => b.createdAt.compareTo(a.createdAt));

                  return ListView.separated(
                    padding: const EdgeInsets.symmetric(horizontal: AppSizes.l, vertical: AppSizes.s),
                    itemCount: txList.length,
                    separatorBuilder: (_, __) => AppSizes.spaceM,
                    itemBuilder: (context, index) {
                      final tx = txList[index];
                      final isPositive = tx.amount >= 0;
                      final txColor = isPositive ? AppColors.success : AppColors.error;
                      
                      IconData txIcon;
                      switch (tx.transactionType) {
                        case 'task_reward':
                          txIcon = Icons.task_alt_rounded;
                          break;
                        case 'penalty_deduction':
                          txIcon = Icons.trending_down_rounded;
                          break;
                        case 'wishlist_payout':
                          txIcon = Icons.card_giftcard_rounded;
                          break;
                        case 'manual_adjustment':
                          txIcon = Icons.handyman_rounded;
                          break;
                        default:
                          txIcon = Icons.payment_rounded;
                      }

                      return Container(
                        padding: const EdgeInsets.symmetric(horizontal: AppSizes.l, vertical: 12),
                        decoration: BoxDecoration(
                          color: Colors.white,
                          borderRadius: AppSizes.borderRadiusM,
                          border: Border.all(color: AppColors.borderLight, width: 1.2),
                        ),
                        child: Row(
                          children: [
                            // Circular icon badge
                            Container(
                              width: 40,
                              height: 40,
                              decoration: BoxDecoration(
                                color: txColor.withOpacity(0.08),
                                shape: BoxShape.circle,
                              ),
                              child: Icon(txIcon, color: txColor, size: 20),
                            ),
                            AppSizes.spaceL,

                            // Description and date
                            Expanded(
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Text(
                                    tx.description ?? 'Амалиёти молиявӣ',
                                    style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 14, color: AppColors.textPrimaryLight),
                                  ),
                                  const SizedBox(height: 4),
                                  Text(
                                    '${tx.createdAt.day}/${tx.createdAt.month} ${tx.createdAt.hour.toString().padLeft(2, '0')}:${tx.createdAt.minute.toString().padLeft(2, '0')}',
                                    style: const TextStyle(color: Colors.grey, fontSize: 11),
                                  ),
                                ],
                              ),
                            ),

                            // Amount
                            Row(
                              children: [
                                Text(
                                  isPositive 
                                      ? '+${tx.currencyType == 'stars' ? tx.amount.toInt() : tx.amount.toStringAsFixed(1)}'
                                      : '${tx.currencyType == 'stars' ? tx.amount.toInt() : tx.amount.toStringAsFixed(1)}',
                                  style: TextStyle(
                                    fontSize: 16,
                                    fontWeight: FontWeight.w900,
                                    color: txColor,
                                  ),
                                ),
                                const SizedBox(width: 2),
                                Icon(
                                  tx.currencyType == 'stars' ? Icons.star_rounded : Icons.account_balance_wallet_rounded,
                                  color: tx.currencyType == 'stars' ? AppColors.accent : AppColors.success,
                                  size: 16,
                                ),
                              ],
                            ),
                          ],
                        ),
                      );
                    },
                  );
                },
              ),
            ),
          ],
        ),
      ),
    );
  }
}
