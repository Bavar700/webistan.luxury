import 'dart:math';
import 'package:flutter/material.dart';

class RewardCelebrationAnimation extends StatefulWidget {
  final String currency; // '⭐️', '🪙', '💵'
  final int amount;
  final VoidCallback onComplete;

  const RewardCelebrationAnimation({
    super.key,
    required this.currency,
    required this.amount,
    required this.onComplete,
  });

  static void show(BuildContext context, {
    required String currency,
    required int amount,
  }) {
    showGeneralDialog(
      context: context,
      barrierDismissible: false,
      barrierColor: Colors.transparent,
      transitionDuration: const Duration(milliseconds: 300),
      pageBuilder: (context, animation, secondaryAnimation) {
        return RewardCelebrationAnimation(
          currency: currency,
          amount: amount,
          onComplete: () => Navigator.of(context).pop(),
        );
      },
    );
  }

  @override
  State<RewardCelebrationAnimation> createState() => _RewardCelebrationAnimationState();
}

class _RewardCelebrationAnimationState extends State<RewardCelebrationAnimation> with TickerProviderStateMixin {
  late AnimationController _pulseController;
  late List<_FlyingCurrency> _items;

  @override
  void initState() {
    super.initState();
    _pulseController = AnimationController(
      vsync: this,
      duration: const Duration(milliseconds: 400),
    )..repeat(reverse: true);

    final random = Random();
    // Generate 15 flying items
    _items = List.generate(15, (index) => _FlyingCurrency(
      x: random.nextDouble() * 2 - 1.0, // -1 to 1
      y: random.nextDouble() * 2 - 1.0, // -1 to 1
      delay: Duration(milliseconds: random.nextInt(300)),
      controller: AnimationController(
        vsync: this,
        duration: const Duration(milliseconds: 800),
      ),
    ));

    // Start animations
    for (var item in _items) {
      Future.delayed(item.delay, () {
        if (mounted) item.controller.forward();
      });
    }

    // Auto complete after max animation time
    Future.delayed(const Duration(milliseconds: 1500), () {
      if (mounted) widget.onComplete();
    });
  }

  @override
  void dispose() {
    _pulseController.dispose();
    for (var item in _items) {
      item.controller.dispose();
    }
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Material(
      color: Colors.black.withOpacity(0.5),
      child: Stack(
        alignment: Alignment.center,
        children: [
          // The flying particles
          ..._items.map((item) {
            return AnimatedBuilder(
              animation: item.controller,
              builder: (context, child) {
                // Easing out the movement
                final progress = Curves.easeOutQuad.transform(item.controller.value);
                
                // Opacity fades out at the end
                final opacity = item.controller.value > 0.8 
                    ? 1.0 - ((item.controller.value - 0.8) * 5)
                    : 1.0;

                return Transform.translate(
                  offset: Offset(
                    item.x * 200 * progress,
                    item.y * 300 * progress - (progress * 100), // general upward motion
                  ),
                  child: Opacity(
                    opacity: opacity,
                    child: Transform.scale(
                      scale: 1.0 - (progress * 0.3), // Slightly shrink
                      child: Text(
                        widget.currency,
                        style: const TextStyle(fontSize: 40),
                      ),
                    ),
                  ),
                );
              },
            );
          }),

          // The central text
          AnimatedBuilder(
            animation: _pulseController,
            builder: (context, child) {
              return Transform.scale(
                scale: 1.0 + (_pulseController.value * 0.1),
                child: child,
              );
            },
            child: Container(
              padding: const EdgeInsets.symmetric(horizontal: 32, vertical: 16),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(30),
                boxShadow: [
                  BoxShadow(
                    color: Colors.white.withOpacity(0.5),
                    blurRadius: 20,
                    spreadRadius: 5,
                  )
                ],
              ),
              child: Text(
                '+${widget.amount} ${widget.currency}',
                style: const TextStyle(
                  fontSize: 36,
                  fontWeight: FontWeight.w900,
                  color: Colors.black,
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}

class _FlyingCurrency {
  final double x;
  final double y;
  final Duration delay;
  final AnimationController controller;

  _FlyingCurrency({
    required this.x,
    required this.y,
    required this.delay,
    required this.controller,
  });
}
