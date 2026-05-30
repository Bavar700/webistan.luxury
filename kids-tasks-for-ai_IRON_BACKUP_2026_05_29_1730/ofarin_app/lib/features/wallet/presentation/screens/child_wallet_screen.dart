// ══════════════════════════════════════════════════════════════════════════════
// Child Wallet Screen — Shows triple currency balances and transaction history
// ══════════════════════════════════════════════════════════════════════════════

import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import '../../../../core/theme/app_colors.dart';
import '../widgets/balance_display.dart';
import '../../data/enums/currency_type.dart';

class ChildWalletScreen extends StatelessWidget {
  const ChildWalletScreen({super.key});

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
          child: SingleChildScrollView(
            padding: const EdgeInsets.all(20),
            child: Column(
              children: [
                const SizedBox(height: 16),
                Text(
                  'my_wallet'.tr(),
                  style: const TextStyle(
                    fontSize: 24,
                    fontWeight: FontWeight.w700,
                    color: AppColors.textPrimary,
                  ),
                ),
                const SizedBox(height: 24),
                const BalanceDisplay(isLarge: true),
                const SizedBox(height: 24),
                // Transaction history
                Align(
                  alignment: Alignment.centerLeft,
                  child: Text(
                    'transaction_history'.tr(),
                    style: const TextStyle(
                      fontSize: 18,
                      fontWeight: FontWeight.w600,
                      color: AppColors.textPrimary,
                    ),
                  ),
                ),
                const SizedBox(height: 12),
                _TransactionItem(
                  type: 'earned',
                  title: 'Уборка комнаты',
                  amount: '+5 ⭐',
                  currency: CurrencyType.star,
                  date: '${'today'.tr()}, 14:30',
                ),
                _TransactionItem(
                  type: 'earned',
                  title: 'Мытьё посуды',
                  amount: '+3 ⭐',
                  currency: CurrencyType.star,
                  date: '${'today'.tr()}, 12:00',
                ),
                _TransactionItem(
                  type: 'spent',
                  title: 'Мороженое',
                  amount: '-2 💰',
                  currency: CurrencyType.fiat,
                  date: '${'yesterday'.tr()}, 18:15',
                ),
                _TransactionItem(
                  type: 'earned',
                  title: 'Отличная оценка',
                  amount: '+1 🏆',
                  currency: CurrencyType.gold,
                  date: '${'yesterday'.tr()}, 10:00',
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

class _TransactionItem extends StatelessWidget {
  final String type;
  final String title;
  final String amount;
  final CurrencyType currency;
  final String date;

  const _TransactionItem({
    required this.type,
    required this.title,
    required this.amount,
    required this.currency,
    required this.date,
  });

  @override
  Widget build(BuildContext context) {
    final isEarned = type == 'earned';
    return Padding(
      padding: const EdgeInsets.only(bottom: 8),
      child: Container(
        padding: const EdgeInsets.all(14),
        decoration: BoxDecoration(
          color: AppColors.surfaceDark,
          borderRadius: BorderRadius.circular(12),
        ),
        child: Row(
          children: [
            Container(
              width: 40,
              height: 40,
              decoration: BoxDecoration(
                color: _getCurrencyColor().withValues(alpha: 0.15),
                borderRadius: BorderRadius.circular(10),
              ),
              child: Icon(
                isEarned ? Icons.arrow_upward : Icons.arrow_downward,
                color: _getCurrencyColor(),
                size: 20,
              ),
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(title, style: const TextStyle(fontSize: 15, fontWeight: FontWeight.w600, color: AppColors.textPrimary)),
                  Text(date, style: const TextStyle(fontSize: 12, color: AppColors.textSecondary)),
                ],
              ),
            ),
            Text(
              amount,
              style: TextStyle(
                fontSize: 16,
                fontWeight: FontWeight.w700,
                color: isEarned ? AppColors.success : AppColors.error,
              ),
            ),
          ],
        ),
      ),
    );
  }

  Color _getCurrencyColor() {
    switch (currency) {
      case CurrencyType.star:
        return AppColors.starCurrency;
      case CurrencyType.gold:
        return AppColors.goldCurrency;
      case CurrencyType.fiat:
        return AppColors.fiatCurrency;
    }
  }
}
