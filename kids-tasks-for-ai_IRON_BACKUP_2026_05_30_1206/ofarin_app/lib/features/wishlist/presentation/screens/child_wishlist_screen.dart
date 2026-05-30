// ══════════════════════════════════════════════════════════════════════════════
// Child Wishlist Screen — Shows wishlist items with progress toward goals
// ══════════════════════════════════════════════════════════════════════════════

import 'package:flutter/material.dart';
import '../../../../core/theme/app_colors.dart';

class ChildWishlistScreen extends StatelessWidget {
  const ChildWishlistScreen({super.key});

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
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    const Text(
                      'Мои мечты',
                      style: TextStyle(
                        fontSize: 24,
                        fontWeight: FontWeight.w700,
                        color: AppColors.textPrimary,
                      ),
                    ),
                    GestureDetector(
                      onTap: () {},
                      child: Container(
                        padding: const EdgeInsets.all(8),
                        decoration: BoxDecoration(
                          color: AppColors.primary.withValues(alpha: 0.15),
                          borderRadius: BorderRadius.circular(12),
                        ),
                        child: const Icon(Icons.add, color: AppColors.primary, size: 28),
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 24),
                _buildWishlistCard(
                  title: 'Новый LEGO',
                  description: 'Набор космический корабль',
                  progressFiat: 30,
                  totalFiat: 50,
                  starsProgress: 10,
                  starsTotal: 20,
                  goldProgress: 1,
                  goldTotal: 3,
                ),
                const SizedBox(height: 12),
                _buildWishlistCard(
                  title: 'Велосипед',
                  description: 'Горный велосипед, синий',
                  progressFiat: 200,
                  totalFiat: 500,
                  starsProgress: 15,
                  starsTotal: 50,
                  goldProgress: 2,
                  goldTotal: 5,
                ),
                const SizedBox(height: 12),
                Container(
                  padding: const EdgeInsets.all(20),
                  decoration: BoxDecoration(
                    color: AppColors.surfaceDark,
                    borderRadius: BorderRadius.circular(16),
                    border: Border.all(
                      color: AppColors.primary.withValues(alpha: 0.2),
                      style: BorderStyle.solid,
                    ),
                  ),
                  child: Column(
                    children: [
                      const Icon(Icons.add_circle_outline, size: 48, color: AppColors.textSecondary),
                      const SizedBox(height: 12),
                      const Text(
                        'Добавьте новую мечту',
                        style: TextStyle(color: AppColors.textSecondary, fontSize: 16),
                      ),
                      const SizedBox(height: 12),
                      SizedBox(
                        width: double.infinity,
                        child: ElevatedButton(
                          onPressed: () {},
                          child: const Text('Создать мечту'),
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildWishlistCard({
    required String title,
    required String description,
    required double progressFiat,
    required double totalFiat,
    required int starsProgress,
    required int starsTotal,
    required int goldProgress,
    required int goldTotal,
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
              Container(
                width: 56,
                height: 56,
                decoration: BoxDecoration(
                  color: AppColors.backgroundDark,
                  borderRadius: BorderRadius.circular(12),
                ),
                child: const Icon(Icons.card_giftcard, color: AppColors.primary, size: 28),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(title, style: const TextStyle(fontSize: 18, fontWeight: FontWeight.w600, color: AppColors.textPrimary)),
                    Text(description, style: const TextStyle(fontSize: 14, color: AppColors.textSecondary)),
                  ],
                ),
              ),
            ],
          ),
          const SizedBox(height: 16),
          // Progress bars
          _buildProgressRow('💰 TJS', progressFiat, totalFiat, AppColors.fiatCurrency),
          const SizedBox(height: 8),
          _buildProgressRow('⭐ Звёзды', starsProgress.toDouble(), starsTotal.toDouble(), AppColors.starCurrency),
          const SizedBox(height: 8),
          _buildProgressRow('🏆 Золото', goldProgress.toDouble(), goldTotal.toDouble(), AppColors.goldCurrency),
        ],
      ),
    );
  }

  Widget _buildProgressRow(String label, double current, double total, Color color) {
    final progress = total > 0 ? current / total : 0.0;
    return Row(
      children: [
        SizedBox(
          width: 80,
          child: Text(label, style: const TextStyle(fontSize: 12, color: AppColors.textSecondary)),
        ),
        Expanded(
          child: ClipRRect(
            borderRadius: BorderRadius.circular(4),
            child: LinearProgressIndicator(
              value: progress,
              backgroundColor: AppColors.backgroundDark,
              valueColor: AlwaysStoppedAnimation<Color>(color),
              minHeight: 8,
            ),
          ),
        ),
        const SizedBox(width: 8),
        Text(
          '${current.toInt()}/${total.toInt()}',
          style: TextStyle(fontSize: 12, fontWeight: FontWeight.w600, color: color),
        ),
      ],
    );
  }
}
