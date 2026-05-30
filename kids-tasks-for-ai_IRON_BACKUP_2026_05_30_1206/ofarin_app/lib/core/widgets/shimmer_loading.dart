// ══════════════════════════════════════════════════════════════════════════════
// Shimmer Loading — Reusable shimmer placeholder widgets
// ══════════════════════════════════════════════════════════════════════════════

import 'package:flutter/material.dart';
import 'package:shimmer/shimmer.dart';
import '../theme/app_colors.dart';

class ShimmerLoading extends StatelessWidget {
  final int itemCount;
  final double itemHeight;
  final double borderRadius;

  const ShimmerLoading({
    super.key,
    this.itemCount = 3,
    this.itemHeight = 88,
    this.borderRadius = 16,
  });

  @override
  Widget build(BuildContext context) {
    return Shimmer.fromColors(
      baseColor: AppColors.surfaceDark,
      highlightColor: const Color(0xFF2A2A5E),
      child: Column(
        children: List.generate(
          itemCount,
          (index) => Padding(
            padding: const EdgeInsets.only(bottom: 12),
            child: Container(
              height: itemHeight,
              decoration: BoxDecoration(
                color: AppColors.surfaceDark,
                borderRadius: BorderRadius.circular(borderRadius),
              ),
            ),
          ),
        ),
      ),
    );
  }
}

class ShimmerCard extends StatelessWidget {
  final double height;
  final double? width;
  final double borderRadius;

  const ShimmerCard({
    super.key,
    this.height = 120,
    this.width,
    this.borderRadius = 16,
  });

  @override
  Widget build(BuildContext context) {
    return Shimmer.fromColors(
      baseColor: AppColors.surfaceDark,
      highlightColor: const Color(0xFF2A2A5E),
      child: Container(
        height: height,
        width: width,
        decoration: BoxDecoration(
          color: AppColors.surfaceDark,
          borderRadius: BorderRadius.circular(borderRadius),
        ),
      ),
    );
  }
}

class ShimmerCircle extends StatelessWidget {
  final double size;

  const ShimmerCircle({super.key, this.size = 48});

  @override
  Widget build(BuildContext context) {
    return Shimmer.fromColors(
      baseColor: AppColors.surfaceDark,
      highlightColor: const Color(0xFF2A2A5E),
      child: Container(
        width: size,
        height: size,
        decoration: const BoxDecoration(
          color: AppColors.surfaceDark,
          shape: BoxShape.circle,
        ),
      ),
    );
  }
}
