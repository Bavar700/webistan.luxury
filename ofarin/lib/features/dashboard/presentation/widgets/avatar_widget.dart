import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import '../../../../core/state/app_state.dart';
import '../../../../core/models/xp_level_system.dart';

class AvatarWidget extends ConsumerWidget {
  const AvatarWidget({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final user = ref.watch(userProvider);
    if (user == null) return const SizedBox.shrink();

    final levelInfo = XpLevelSystem.getLevelInfo(user.totalXp);
    final progress = levelInfo['progress'] as double;
    final level = levelInfo['level'] as int;
    final badge = levelInfo['badge'] as String;
    final title = levelInfo['title'] as String;

    return Column(
      mainAxisSize: MainAxisSize.min,
      children: [
        // Avatar with Circular Progress
        Stack(
          alignment: Alignment.center,
          children: [
            SizedBox(
              width: 100,
              height: 100,
              child: CircularProgressIndicator(
                value: progress,
                strokeWidth: 8,
                backgroundColor: Colors.white.withOpacity(0.1),
                valueColor: AlwaysStoppedAnimation<Color>(const Color(0xFF4FC3F7)),
              ),
            ),
            Container(
              width: 80,
              height: 80,
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: Colors.white.withOpacity(0.1),
                boxShadow: [
                  BoxShadow(
                    color: const Color(0xFF4FC3F7).withOpacity(0.3),
                    blurRadius: 20,
                    spreadRadius: 2,
                  ),
                ],
              ),
              child: Center(
                child: Text(
                  user.avatarEmoji,
                  style: const TextStyle(fontSize: 40),
                ),
              ),
            ),
            // Level Badge
            Positioned(
              bottom: 0,
              right: 0,
              child: Container(
                padding: const EdgeInsets.all(4),
                decoration: const BoxDecoration(
                  color: Color(0xFF1E2444),
                  shape: BoxShape.circle,
                ),
                child: Text(
                  badge,
                  style: const TextStyle(fontSize: 20),
                ),
              ),
            ),
          ],
        ),
        const SizedBox(height: 12),
        // Name and Level Info
        Text(
          user.name,
          style: const TextStyle(
            fontSize: 24,
            fontWeight: FontWeight.bold,
            color: Colors.white,
          ),
        ),
        const SizedBox(height: 4),
        Container(
          padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
          decoration: BoxDecoration(
            color: const Color(0xFF4FC3F7).withOpacity(0.2),
            borderRadius: BorderRadius.circular(12),
            border: Border.all(color: const Color(0xFF4FC3F7).withOpacity(0.5)),
          ),
          child: Text(
            'Сатҳи $level • $title',
            style: const TextStyle(
              color: Color(0xFF4FC3F7),
              fontWeight: FontWeight.bold,
              fontSize: 14,
            ),
          ),
        ),
      ],
    );
  }
}
