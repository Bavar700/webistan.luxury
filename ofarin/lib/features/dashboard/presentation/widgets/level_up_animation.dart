import 'dart:math';
import 'package:flutter/material.dart';

class LevelUpAnimation extends StatefulWidget {
  final int newLevel;
  final String badge;
  final String title;
  final VoidCallback onComplete;

  const LevelUpAnimation({
    super.key,
    required this.newLevel,
    required this.badge,
    required this.title,
    required this.onComplete,
  });

  /// Show the level up overlay on top of the current screen
  static void show(
    BuildContext context, {
    required int newLevel,
    required String badge,
    required String title,
  }) {
    showGeneralDialog(
      context: context,
      barrierDismissible: false,
      barrierColor: Colors.black.withOpacity(0.7),
      transitionDuration: const Duration(milliseconds: 500),
      pageBuilder: (context, animation, secondaryAnimation) {
        return LevelUpAnimation(
          newLevel: newLevel,
          badge: badge,
          title: title,
          onComplete: () => Navigator.of(context).pop(),
        );
      },
      transitionBuilder: (context, animation, secondaryAnimation, child) {
        return FadeTransition(
          opacity: animation,
          child: ScaleTransition(
            scale: CurvedAnimation(parent: animation, curve: Curves.elasticOut),
            child: child,
          ),
        );
      },
    );
  }

  @override
  State<LevelUpAnimation> createState() => _LevelUpAnimationState();
}

class _LevelUpAnimationState extends State<LevelUpAnimation>
    with TickerProviderStateMixin {
  late AnimationController _badgeController;
  late AnimationController _confettiController;
  late AnimationController _textController;
  late Animation<double> _badgeScale;
  late Animation<double> _badgeRotation;
  late Animation<double> _textSlide;
  late Animation<double> _textOpacity;
  late List<ConfettiParticle> _particles;

  @override
  void initState() {
    super.initState();

    // Badge animation
    _badgeController = AnimationController(
      vsync: this,
      duration: const Duration(milliseconds: 1200),
    );
    _badgeScale = TweenSequence<double>([
      TweenSequenceItem(tween: Tween(begin: 0.0, end: 1.3), weight: 60),
      TweenSequenceItem(tween: Tween(begin: 1.3, end: 1.0), weight: 40),
    ]).animate(CurvedAnimation(parent: _badgeController, curve: Curves.easeOut));
    _badgeRotation = Tween<double>(begin: -0.1, end: 0.0)
        .animate(CurvedAnimation(parent: _badgeController, curve: Curves.elasticOut));

    // Confetti animation
    _confettiController = AnimationController(
      vsync: this,
      duration: const Duration(seconds: 3),
    );
    final random = Random();
    _particles = List.generate(60, (_) => ConfettiParticle(
      x: random.nextDouble(),
      y: random.nextDouble() * -1.0,
      size: random.nextDouble() * 8 + 4,
      speed: random.nextDouble() * 0.3 + 0.2,
      color: [
        const Color(0xFFFFD700),
        const Color(0xFF6C63FF),
        const Color(0xFF4FC3F7),
        const Color(0xFFFF6B6B),
        const Color(0xFF66BB6A),
        const Color(0xFFFF9800),
        const Color(0xFFE040FB),
      ][random.nextInt(7)],
      rotation: random.nextDouble() * pi * 2,
      rotationSpeed: random.nextDouble() * 2 - 1,
      horizontalDrift: random.nextDouble() * 0.4 - 0.2,
    ));

    // Text animation
    _textController = AnimationController(
      vsync: this,
      duration: const Duration(milliseconds: 800),
    );
    _textSlide = Tween<double>(begin: 50.0, end: 0.0)
        .animate(CurvedAnimation(parent: _textController, curve: Curves.easeOutBack));
    _textOpacity = Tween<double>(begin: 0.0, end: 1.0)
        .animate(CurvedAnimation(parent: _textController, curve: Curves.easeIn));

    // Sequence the animations
    _badgeController.forward();
    Future.delayed(const Duration(milliseconds: 300), () {
      if (mounted) _confettiController.forward();
    });
    Future.delayed(const Duration(milliseconds: 600), () {
      if (mounted) _textController.forward();
    });

    // Auto close after 3.5 seconds
    Future.delayed(const Duration(milliseconds: 3500), () {
      if (mounted) widget.onComplete();
    });
  }

  @override
  void dispose() {
    _badgeController.dispose();
    _confettiController.dispose();
    _textController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Material(
      color: Colors.transparent,
      child: Stack(
        children: [
          // Confetti layer
          AnimatedBuilder(
            animation: _confettiController,
            builder: (context, _) {
              return CustomPaint(
                painter: ConfettiPainter(_particles, _confettiController.value),
                size: Size.infinite,
              );
            },
          ),

          // Center content
          Center(
            child: Column(
              mainAxisSize: MainAxisSize.min,
              children: [
                // Glow ring behind badge
                AnimatedBuilder(
                  animation: _badgeController,
                  builder: (context, child) {
                    return Transform.rotate(
                      angle: _badgeRotation.value,
                      child: Transform.scale(
                        scale: _badgeScale.value,
                        child: child,
                      ),
                    );
                  },
                  child: Container(
                    width: 140,
                    height: 140,
                    decoration: BoxDecoration(
                      shape: BoxShape.circle,
                      gradient: RadialGradient(
                        colors: [
                          const Color(0xFFFFD700).withOpacity(0.3),
                          const Color(0xFFFFD700).withOpacity(0.1),
                          Colors.transparent,
                        ],
                      ),
                      boxShadow: [
                        BoxShadow(
                          color: const Color(0xFFFFD700).withOpacity(0.5),
                          blurRadius: 30,
                          spreadRadius: 5,
                        ),
                      ],
                    ),
                    child: Center(
                      child: Text(
                        widget.badge,
                        style: const TextStyle(fontSize: 72),
                      ),
                    ),
                  ),
                ),

                const SizedBox(height: 24),

                // Level text
                AnimatedBuilder(
                  animation: _textController,
                  builder: (context, child) {
                    return Transform.translate(
                      offset: Offset(0, _textSlide.value),
                      child: Opacity(
                        opacity: _textOpacity.value,
                        child: child,
                      ),
                    );
                  },
                  child: Column(
                    children: [
                      const Text(
                        '🎉 Сатҳи нав! 🎉',
                        style: TextStyle(
                          fontSize: 32,
                          fontWeight: FontWeight.w900,
                          color: Color(0xFFFFD700),
                          shadows: [
                            Shadow(
                              color: Color(0xFFFFD700),
                              blurRadius: 20,
                            ),
                          ],
                        ),
                      ),
                      const SizedBox(height: 8),
                      Text(
                        'Сатҳи ${widget.newLevel}',
                        style: const TextStyle(
                          fontSize: 48,
                          fontWeight: FontWeight.w900,
                          color: Colors.white,
                        ),
                      ),
                      const SizedBox(height: 4),
                      Container(
                        padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 8),
                        decoration: BoxDecoration(
                          gradient: const LinearGradient(
                            colors: [Color(0xFF6C63FF), Color(0xFF4FC3F7)],
                          ),
                          borderRadius: BorderRadius.circular(20),
                        ),
                        child: Text(
                          widget.title,
                          style: const TextStyle(
                            fontSize: 18,
                            fontWeight: FontWeight.bold,
                            color: Colors.white,
                          ),
                        ),
                      ),
                      const SizedBox(height: 24),
                      Text(
                        'Офарин! Ту метавонӣ! 💪',
                        style: TextStyle(
                          fontSize: 18,
                          color: Colors.white.withOpacity(0.8),
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),

          // Tap to dismiss
          Positioned.fill(
            child: GestureDetector(
              onTap: widget.onComplete,
              behavior: HitTestBehavior.translucent,
            ),
          ),
        ],
      ),
    );
  }
}

// --- Confetti System ---

class ConfettiParticle {
  final double x, y, size, speed, rotation, rotationSpeed, horizontalDrift;
  final Color color;

  ConfettiParticle({
    required this.x,
    required this.y,
    required this.size,
    required this.speed,
    required this.color,
    required this.rotation,
    required this.rotationSpeed,
    required this.horizontalDrift,
  });
}

class ConfettiPainter extends CustomPainter {
  final List<ConfettiParticle> particles;
  final double progress;

  ConfettiPainter(this.particles, this.progress);

  @override
  void paint(Canvas canvas, Size size) {
    for (final particle in particles) {
      final currentY = particle.y + progress * (1.5) * particle.speed;
      final currentX = particle.x + sin(progress * pi * 3 * particle.rotationSpeed) * particle.horizontalDrift;

      if (currentY > 1.2 || currentY < -0.1) continue;

      final paint = Paint()
        ..color = particle.color.withOpacity(1.0 - progress * 0.5)
        ..style = PaintingStyle.fill;

      canvas.save();
      canvas.translate(
        currentX * size.width,
        currentY * size.height,
      );
      canvas.rotate(particle.rotation + progress * particle.rotationSpeed * pi * 2);

      // Draw different shapes
      if (particle.size > 8) {
        // Circle
        canvas.drawCircle(Offset.zero, particle.size / 2, paint);
      } else if (particle.size > 5) {
        // Rectangle
        canvas.drawRect(
          Rect.fromCenter(center: Offset.zero, width: particle.size, height: particle.size * 0.6),
          paint,
        );
      } else {
        // Small diamond
        final path = Path()
          ..moveTo(0, -particle.size / 2)
          ..lineTo(particle.size / 3, 0)
          ..lineTo(0, particle.size / 2)
          ..lineTo(-particle.size / 3, 0)
          ..close();
        canvas.drawPath(path, paint);
      }
      canvas.restore();
    }
  }

  @override
  bool shouldRepaint(covariant ConfettiPainter old) => true;
}
