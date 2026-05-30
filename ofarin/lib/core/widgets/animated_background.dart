import 'dart:math';
import 'package:flutter/material.dart';

class AnimatedBackground extends StatefulWidget {
  final Widget child;
  final int starCount;

  const AnimatedBackground({
    super.key,
    required this.child,
    this.starCount = 50,
  });

  @override
  State<AnimatedBackground> createState() => _AnimatedBackgroundState();
}

class _AnimatedBackgroundState extends State<AnimatedBackground>
    with TickerProviderStateMixin {
  late AnimationController _controller;
  late List<Star> _stars;

  @override
  void initState() {
    super.initState();
    _controller = AnimationController(
      vsync: this,
      duration: const Duration(seconds: 3),
    )..repeat();
    final random = Random();
    _stars = List.generate(
      widget.starCount,
      (_) => Star(
        x: random.nextDouble(),
        y: random.nextDouble(),
        size: random.nextDouble() * 2 + 0.5,
        speed: random.nextDouble() * 0.5 + 0.5,
        opacity: random.nextDouble() * 0.5 + 0.3,
      ),
    );
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Stack(
      children: [
        // Night sky gradient
        Container(
          decoration: const BoxDecoration(
            gradient: LinearGradient(
              begin: Alignment.topCenter,
              end: Alignment.bottomCenter,
              colors: [
                Color(0xFF0F0C29),
                Color(0xFF302B63),
                Color(0xFF24243E),
              ],
            ),
          ),
        ),
        // Animated stars
        AnimatedBuilder(
          animation: _controller,
          builder: (context, _) {
            return CustomPaint(
              painter: StarPainter(_stars, _controller.value),
              size: Size.infinite,
            );
          },
        ),
        // Content
        widget.child,
      ],
    );
  }
}

class Star {
  final double x;
  final double y;
  final double size;
  final double speed;
  final double opacity;

  Star({
    required this.x,
    required this.y,
    required this.size,
    required this.speed,
    required this.opacity,
  });
}

class StarPainter extends CustomPainter {
  final List<Star> stars;
  final double animationValue;

  StarPainter(this.stars, this.animationValue);

  @override
  void paint(Canvas canvas, Size size) {
    for (final star in stars) {
      // Twinkling effect
      final twinkle =
          (sin((animationValue * 2 * pi * star.speed) + star.x * 10) + 1) / 2;
      final paint = Paint()
        ..color =
            Colors.white.withOpacity(star.opacity * (0.3 + twinkle * 0.7))
        ..maskFilter = MaskFilter.blur(BlurStyle.normal, star.size * 0.5);
      canvas.drawCircle(
        Offset(star.x * size.width, star.y * size.height),
        star.size,
        paint,
      );
    }
  }

  @override
  bool shouldRepaint(covariant StarPainter old) => true;
}
