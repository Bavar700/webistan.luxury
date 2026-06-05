// ══════════════════════════════════════════════════════════════════════════════
// Wishlist Approval Screen — Parent manages children's wishes
// ══════════════════════════════════════════════════════════════════════════════

import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import '../../../../core/theme/app_colors.dart';

class WishlistApprovalScreen extends StatelessWidget {
  const WishlistApprovalScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Мечты детей'),
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
            // Pending pricing
            const Text(
              'Ожидают оценки',
              style: TextStyle(
                fontSize: 18,
                fontWeight: FontWeight.w700,
                color: AppColors.textPrimary,
              ),
            ),
            const SizedBox(height: 12),
            _buildWishCard(
              childName: 'Амир',
              title: 'Новый LEGO Космос',
              status: 'Установите цену',
            ),
            const SizedBox(height: 12),
            // Active goals
            const SizedBox(height: 16),
            const Text(
              'В процессе',
              style: TextStyle(
                fontSize: 18,
                fontWeight: FontWeight.w700,
                color: AppColors.textPrimary,
              ),
            ),
            const SizedBox(height: 12),
            _buildWishCard(
              childName: 'Амир',
              title: 'Велосипед',
              status: '50% собрано',
              showFulfill: true,
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildWishCard({
    required String childName,
    required String title,
    required String status,
    bool showFulfill = false,
  }) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: AppColors.surfaceDark,
        borderRadius: BorderRadius.circular(16),
      ),
      child: Row(
        children: [
          CircleAvatar(
            backgroundColor: AppColors.accent,
            child: Text(childName[0], style: const TextStyle(color: Colors.white, fontWeight: FontWeight.w700)),
          ),
          const SizedBox(width: 12),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(title, style: const TextStyle(fontSize: 16, fontWeight: FontWeight.w600, color: AppColors.textPrimary)),
                Text(status, style: const TextStyle(fontSize: 13, color: AppColors.primary)),
              ],
            ),
          ),
          if (showFulfill)
            ElevatedButton(
              onPressed: () {},
              style: ElevatedButton.styleFrom(
                backgroundColor: AppColors.success,
                padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
              ),
              child: const Text('Куплено', style: TextStyle(fontSize: 12)),
            )
          else
            ElevatedButton(
              onPressed: () {},
              style: ElevatedButton.styleFrom(
                padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
              ),
              child: const Text('Оценить', style: TextStyle(fontSize: 12)),
            ),
        ],
      ),
    );
  }
}
