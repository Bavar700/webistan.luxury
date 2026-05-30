import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import '../../../../core/state/app_state.dart';
import '../../../../core/models/xp_level_system.dart';
import '../../../../core/widgets/glassmorphic_card.dart';

class ChildDashboardTab extends ConsumerWidget {
  const ChildDashboardTab({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final user = ref.watch(userProvider);
    final wallet = ref.watch(walletProvider);
    
    if (user == null) return const Center(child: CircularProgressIndicator());

    final progress = XpLevelSystem.getProgressToNextLevel(user.totalXp);
    final xpNeeded = XpLevelSystem.getXpToNextLevel(user.totalXp);
    final levelTitle = XpLevelSystem.getLevelTitle(user.level);

    return SingleChildScrollView(
      padding: const EdgeInsets.all(16),
      child: Column(
        children: [
          // Wallet Status
          GlassmorphicCard(
            padding: const EdgeInsets.all(16),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
              children: [
                _buildWalletItem('⭐️', '${wallet.balanceStars}', Colors.blueAccent),
                _buildWalletItem('🪙', '${wallet.balanceCoins}', Colors.amber),
              ],
            ),
          ),
          const SizedBox(height: 32),
          
          // Avatar
          Container(
            width: 120,
            height: 120,
            decoration: BoxDecoration(
              color: Colors.white.withValues(alpha: 0.1),
              shape: BoxShape.circle,
              border: Border.all(color: Colors.amber, width: 3),
              boxShadow: [
                BoxShadow(color: Colors.amber.withValues(alpha: 0.3), blurRadius: 20, spreadRadius: 5),
              ],
            ),
            child: Center(
              child: Text(user.avatarEmoji, style: const TextStyle(fontSize: 60)),
            ),
          ),
          const SizedBox(height: 16),
          
          Text(
            user.name,
            style: const TextStyle(color: Colors.white, fontSize: 24, fontWeight: FontWeight.bold),
          ),
          const SizedBox(height: 8),
          
          Text(
            'Сатҳи ${user.level}: $levelTitle',
            style: const TextStyle(color: Colors.amber, fontSize: 18, fontWeight: FontWeight.w500),
          ),
          
          const SizedBox(height: 32),
          
          // Level Progress
          GlassmorphicCard(
            padding: const EdgeInsets.all(20),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text('Сатҳи ${user.level}', style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
                    Text('Сатҳи ${user.level + 1}', style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
                  ],
                ),
                const SizedBox(height: 12),
                ClipRRect(
                  borderRadius: BorderRadius.circular(10),
                  child: LinearProgressIndicator(
                    value: progress,
                    minHeight: 12,
                    backgroundColor: Colors.white.withValues(alpha: 0.1),
                    valueColor: const AlwaysStoppedAnimation<Color>(Colors.blueAccent),
                  ),
                ),
                const SizedBox(height: 12),
                Center(
                  child: Text(
                    'Барои сатҳи оянда $xpNeeded XP лозим аст',
                    style: const TextStyle(color: Colors.white70, fontSize: 14),
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildWalletItem(String icon, String amount, Color color) {
    return Row(
      mainAxisSize: MainAxisSize.min,
      children: [
        Text(icon, style: const TextStyle(fontSize: 24)),
        const SizedBox(width: 8),
        Text(
          amount,
          style: TextStyle(color: color, fontSize: 24, fontWeight: FontWeight.bold),
        ),
      ],
    );
  }
}
