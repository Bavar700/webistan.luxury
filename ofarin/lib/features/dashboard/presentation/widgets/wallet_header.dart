import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:ofarin/core/state/app_state.dart';

class WalletHeader extends ConsumerWidget {
  const WalletHeader({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final wallet = ref.watch(walletProvider);
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
      decoration: BoxDecoration(
        color: const Color(0xFF1C1C1E),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.5),
            blurRadius: 10,
            offset: const Offset(0, 4),
          )
        ],
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        children: [
          // Stars
          Expanded(child: _WalletItem(icon: '⭐️', amount: '${wallet.balanceStars}', color: Colors.blueAccent)),
          const SizedBox(width: 4),
          // Gold
          Expanded(child: _WalletItem(icon: '🪙', amount: '${wallet.balanceCoins}', color: Colors.amber)),
          const SizedBox(width: 4),
          // Fiat Money
          Expanded(child: _WalletItem(icon: '💵', amount: '${wallet.balanceFiat} TJS', color: Colors.green)),
        ],
      ),
    );
  }
}

class _WalletItem extends StatelessWidget {
  final String icon;
  final String amount;
  final Color color;

  const _WalletItem({
    required this.icon,
    required this.amount,
    required this.color,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
      decoration: BoxDecoration(
        color: color.withOpacity(0.1),
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: color.withOpacity(0.3)),
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Text(icon, style: const TextStyle(fontSize: 16)),
          const SizedBox(width: 4),
          Expanded(
            child: FittedBox(
              fit: BoxFit.scaleDown,
              alignment: Alignment.centerLeft,
              child: Text(
                amount,
                style: const TextStyle(
                  color: Colors.white,
                  fontWeight: FontWeight.bold,
                  fontSize: 16,
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
