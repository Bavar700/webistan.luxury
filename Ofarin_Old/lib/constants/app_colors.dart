import 'package:flutter/material.dart';

class AppColors {
  AppColors._();

  // 🎨 PRIMARY — Vibrant Purple (fun, playful)
  static const Color primary = Color(0xFF7C3AED);       // Deep Violet
  static const Color primaryLight = Color(0xFFA78BFA);   // Soft Lavender
  static const Color primaryDark = Color(0xFF5B21B6);    // Dark Violet

  // 🌟 ACCENT — Sunny Yellow/Orange
  static const Color accent = Color(0xFFF59E0B);          // Amber (Stars)
  static const Color accentLight = Color(0xFFFCD34D);
  static const Color accentDark = Color(0xFFD97706);

  // 🌈 FUN COLORS (for kid cards, avatars, badges)
  static const Color funPink = Color(0xFFEC4899);
  static const Color funOrange = Color(0xFFF97316);
  static const Color funGreen = Color(0xFF10B981);
  static const Color funBlue = Color(0xFF3B82F6);
  static const Color funTeal = Color(0xFF14B8A6);
  static const Color funRed = Color(0xFFEF4444);

  // ✅ STATUS
  static const Color success = Color(0xFF10B981);
  static const Color error = Color(0xFFEF4444);
  static const Color info = Color(0xFF3B82F6);
  static const Color warning = Color(0xFFF97316);

  // 🌤 LIGHT MODE
  static const Color bgLight = Color(0xFFF5F3FF);        // Very light purple tint
  static const Color bgLightAlt = Color(0xFFFFF7ED);     // Warm cream
  static const Color cardLight = Color(0xFFFFFFFF);
  static const Color textPrimaryLight = Color(0xFF1E1B4B);  // Deep indigo
  static const Color textSecondaryLight = Color(0xFF6B7280);
  static const Color borderLight = Color(0xFFE5E7EB);

  // 🌙 DARK MODE
  static const Color bgDark = Color(0xFF1E1B4B);
  static const Color cardDark = Color(0xFF2D2A6B);
  static const Color textPrimaryDark = Color(0xFFF8FAFC);
  static const Color textSecondaryDark = Color(0xFFA5B4FC);
  static const Color borderDark = Color(0xFF4338CA);

  // 🎆 GRADIENTS
  static const Gradient primaryGradient = LinearGradient(
    colors: [Color(0xFF7C3AED), Color(0xFFEC4899)], // Purple → Pink
    begin: Alignment.topLeft,
    end: Alignment.bottomRight,
  );

  static const Gradient accentGradient = LinearGradient(
    colors: [Color(0xFFF59E0B), Color(0xFFF97316)], // Gold → Orange
    begin: Alignment.topLeft,
    end: Alignment.bottomRight,
  );

  static const Gradient successGradient = LinearGradient(
    colors: [Color(0xFF10B981), Color(0xFF14B8A6)], // Green → Teal
    begin: Alignment.topLeft,
    end: Alignment.bottomRight,
  );

  static const Gradient funGradient1 = LinearGradient(
    colors: [Color(0xFF3B82F6), Color(0xFF8B5CF6)], // Blue → Purple
    begin: Alignment.topLeft,
    end: Alignment.bottomRight,
  );

  static const Gradient funGradient2 = LinearGradient(
    colors: [Color(0xFFEC4899), Color(0xFFF97316)], // Pink → Orange
    begin: Alignment.topLeft,
    end: Alignment.bottomRight,
  );

  static const Gradient skyGradient = LinearGradient(
    colors: [Color(0xFF7C3AED), Color(0xFF3B82F6), Color(0xFF06B6D4)],
    begin: Alignment.topLeft,
    end: Alignment.bottomRight,
  );

  static const Gradient cardGlassGradient = LinearGradient(
    colors: [Color(0x1AFFFFFF), Color(0x0DFFFFFF)],
    begin: Alignment.topLeft,
    end: Alignment.bottomRight,
  );

  // Fun background gradient for child screens
  static const Gradient childBgGradient = LinearGradient(
    colors: [
      Color(0xFFEEF2FF), // Cool soft indigo
      Color(0xFFF5F3FF), // Soft lavender
      Color(0xFFFFF0F5), // Soft lavender-pink blush
    ],
    begin: Alignment.topCenter,
    end: Alignment.bottomCenter,
  );
}
