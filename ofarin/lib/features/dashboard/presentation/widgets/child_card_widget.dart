import 'package:flutter/material.dart';
import '../../../../core/models/user_model.dart';
import '../../../../core/models/wallet_model.dart';
import '../../../../core/models/xp_level_system.dart';
import '../../../../core/widgets/glassmorphic_card.dart';

class ChildCardWidget extends StatelessWidget {
  final UserModel child;
  final WalletModel wallet;
  final int pendingTasksCount;
  final VoidCallback onTap;

  const ChildCardWidget({
    super.key,
    required this.child,
    required this.wallet,
    this.pendingTasksCount = 0,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    final levelInfo = XpLevelSystem.getLevelInfo(child.totalXp);
    final progress = levelInfo['progress'] as double;
    final level = levelInfo['level'] as int;

    return GestureDetector(
      onTap: onTap,
      child: GlassmorphicCard(
        margin: const EdgeInsets.only(bottom: 16),
        padding: const EdgeInsets.all(16),
        opacity: 0.15,
        borderColor: pendingTasksCount > 0 ? Colors.orange : Colors.white,
        child: Column(
          children: [
            Row(
              children: [
                // Avatar
                Stack(
                  children: [
                    Container(
                      width: 60,
                      height: 60,
                      decoration: BoxDecoration(
                        shape: BoxShape.circle,
                        color: Colors.white.withOpacity(0.1),
                        border: Border.all(color: const Color(0xFF4FC3F7), width: 2),
                      ),
                      child: Center(
                        child: Text(
                          child.avatarEmoji,
                          style: const TextStyle(fontSize: 32),
                        ),
                      ),
                    ),
                    if (pendingTasksCount > 0)
                      Positioned(
                        top: 0,
                        right: 0,
                        child: Container(
                          padding: const EdgeInsets.all(4),
                          decoration: const BoxDecoration(
                            color: Colors.red,
                            shape: BoxShape.circle,
                          ),
                          child: Text(
                            pendingTasksCount.toString(),
                            style: const TextStyle(
                              color: Colors.white,
                              fontSize: 12,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                        ),
                      ),
                  ],
                ),
                const SizedBox(width: 16),
                
                // Name & Level
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        child.name,
                        style: const TextStyle(
                          color: Colors.white,
                          fontSize: 18,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      const SizedBox(height: 4),
                      Text(
                        'Сатҳи $level',
                        style: const TextStyle(
                          color: Color(0xFF4FC3F7),
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      const SizedBox(height: 8),
                      // Progress Bar
                      ClipRRect(
                        borderRadius: BorderRadius.circular(10),
                        child: LinearProgressIndicator(
                          value: progress,
                          minHeight: 6,
                          backgroundColor: Colors.white.withOpacity(0.1),
                          valueColor: const AlwaysStoppedAnimation<Color>(Color(0xFF4FC3F7)),
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
            const SizedBox(height: 16),
            const Divider(color: Colors.white24),
            const SizedBox(height: 8),
            
            // Wallet Balances
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceAround,
              children: [
                _BalanceItem(icon: '⭐', amount: wallet.balanceStars.toString(), color: const Color(0xFF4FC3F7)),
                _BalanceItem(icon: '🪙', amount: wallet.balanceCoins.toString(), color: const Color(0xFFFFC107)),
                _BalanceItem(icon: '💵', amount: wallet.balanceFiat.toStringAsFixed(0), color: const Color(0xFF66BB6A)),
              ],
            ),
          ],
        ),
      ),
    );
  }
}

class _BalanceItem extends StatelessWidget {
  final String icon;
  final String amount;
  final Color color;

  const _BalanceItem({
    required this.icon,
    required this.amount,
    required this.color,
  });

  @override
  Widget build(BuildContext context) {
    return Row(
      mainAxisSize: MainAxisSize.min,
      children: [
        Text(icon, style: const TextStyle(fontSize: 16)),
        const SizedBox(width: 4),
        Text(
          amount,
          style: TextStyle(
            color: color,
            fontSize: 16,
            fontWeight: FontWeight.bold,
          ),
        ),
      ],
    );
  }
}
