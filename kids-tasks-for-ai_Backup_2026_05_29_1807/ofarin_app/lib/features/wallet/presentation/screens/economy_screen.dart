// ══════════════════════════════════════════════════════════════════════════════
// Economy Screen — Parent's overview of all children's balances
// ══════════════════════════════════════════════════════════════════════════════

import 'package:easy_localization/easy_localization.dart';
import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import '../../../../core/theme/app_colors.dart';

class EconomyScreen extends StatelessWidget {
  const EconomyScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('family_economy'.tr()),
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
        child: ListView(
          padding: const EdgeInsets.all(20),
          children: [
            _buildChildBalanceCard(
              name: 'Амир',
              fiat: '5.50 TJS',
              stars: '12 ⭐',
              gold: '3 🏆',
            ),
            const SizedBox(height: 12),
            _buildChildBalanceCard(
              name: 'Самира',
              fiat: '2.00 TJS',
              stars: '8 ⭐',
              gold: '1 🏆',
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildChildBalanceCard({
    required String name,
    required String fiat,
    required String stars,
    required String gold,
  }) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: AppColors.surfaceDark,
        borderRadius: BorderRadius.circular(16),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              CircleAvatar(
                backgroundColor: AppColors.accent,
                child: Text(name[0], style: const TextStyle(color: Colors.white, fontWeight: FontWeight.w700)),
              ),
              const SizedBox(width: 12),
              Text(name, style: const TextStyle(fontSize: 18, fontWeight: FontWeight.w600, color: AppColors.textPrimary)),
            ],
          ),
          const SizedBox(height: 16),
          Row(
            children: [
              _buildBalanceItem('💰', fiat, AppColors.fiatCurrency),
              const SizedBox(width: 16),
              _buildBalanceItem('⭐', stars, AppColors.starCurrency),
              const SizedBox(width: 16),
              _buildBalanceItem('🏆', gold, AppColors.goldCurrency),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildBalanceItem(String icon, String amount, Color color) {
    return Expanded(
      child: Container(
        padding: const EdgeInsets.symmetric(vertical: 8),
        decoration: BoxDecoration(
          color: color.withValues(alpha: 0.1),
          borderRadius: BorderRadius.circular(8),
        ),
        child: Column(
          children: [
            Text(icon, style: const TextStyle(fontSize: 20)),
            const SizedBox(height: 4),
            Text(amount, style: TextStyle(fontSize: 14, fontWeight: FontWeight.w600, color: color)),
          ],
        ),
      ),
    );
  }
}
