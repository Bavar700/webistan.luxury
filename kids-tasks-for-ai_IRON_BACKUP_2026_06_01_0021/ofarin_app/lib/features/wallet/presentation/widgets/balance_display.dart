// ══════════════════════════════════════════════════════════════════════════════
// Balance Display — Reusable widget showing triple currency balances
// ══════════════════════════════════════════════════════════════════════════════

import 'package:flutter/material.dart';
import '../../../../core/theme/app_colors.dart';

class BalanceDisplay extends StatelessWidget {
  final bool isLarge;

  const BalanceDisplay({super.key, this.isLarge = false});

  @override
  Widget build(BuildContext context) {
    return Container(
      width: double.infinity,
      padding: EdgeInsets.all(isLarge ? 24 : 16),
      decoration: BoxDecoration(
        gradient: const LinearGradient(
          colors: [AppColors.surfaceDark, Color(0xFF252550)],
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        borderRadius: BorderRadius.circular(20),
        border: Border.all(color: AppColors.primary.withValues(alpha: 0.2)),
        boxShadow: [
          BoxShadow(
            color: AppColors.primary.withValues(alpha: 0.1),
            blurRadius: 20,
            spreadRadius: 2,
          ),
        ],
      ),
      child: Column(
        children: [
          if (isLarge)
            const Padding(
              padding: EdgeInsets.only(bottom: 16),
              child: Text(
                'Текущий баланс',
                style: TextStyle(
                  fontSize: 16,
                  color: AppColors.textSecondary,
                ),
              ),
            ),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
            children: [
              _buildCurrencyItem(
                icon: '💰',
                amount: '12.50',
                label: 'TJS',
                color: AppColors.fiatCurrency,
                isLarge: isLarge,
              ),
              _buildCurrencyItem(
                icon: '⭐',
                amount: '25',
                label: 'Звёзды',
                color: AppColors.starCurrency,
                isLarge: isLarge,
              ),
              _buildCurrencyItem(
                icon: '🏆',
                amount: '5',
                label: 'Золото',
                color: AppColors.goldCurrency,
                isLarge: isLarge,
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildCurrencyItem({
    required String icon,
    required String amount,
    required String label,
    required Color color,
    required bool isLarge,
  }) {
    return Column(
      children: [
        Text(icon, style: TextStyle(fontSize: isLarge ? 32 : 24)),
        const SizedBox(height: 4),
        Text(
          amount,
          style: TextStyle(
            fontSize: isLarge ? 24 : 20,
            fontWeight: FontWeight.w800,
            color: color,
          ),
        ),
        Text(
          label,
          style: TextStyle(
            fontSize: isLarge ? 14 : 12,
            color: AppColors.textSecondary,
          ),
        ),
      ],
    );
  }
}
