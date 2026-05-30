import 'package:flutter/material.dart';

class AppTheme {
  // Core Colors
  static const Color darkBackground = Color(0xFF0A0E21);
  static const Color surfaceColor = Color(0xFF1A1F36);
  static const Color cardColor = Color(0xFF1E2444);

  // Accent Colors
  static const Color goldAccent = Color(0xFFFFD700);
  static const Color primaryPurple = Color(0xFF6C63FF);
  static const Color deepPurple = Color(0xFF2A0845);
  static const Color lightPurple = Color(0xFF6441A5);

  // Currency Colors
  static const Color xpBlue = Color(0xFF4FC3F7);
  static const Color coinGold = Color(0xFFFFC107);
  static const Color moneyGreen = Color(0xFF66BB6A);

  // Status Colors
  static const Color successGreen = Color(0xFF4CAF50);
  static const Color warningOrange = Color(0xFFFF9800);
  static const Color dangerRed = Color(0xFFEF5350);
  static const Color infoBlue = Color(0xFF29B6F6);

  // Text Colors
  static const Color textPrimary = Color(0xFFF5F5F5);
  static const Color textSecondary = Color(0xFFB0B8C8);
  static const Color textMuted = Color(0xFF6B7280);

  // Gradients
  static const LinearGradient primaryGradient = LinearGradient(
    begin: Alignment.topLeft,
    end: Alignment.bottomRight,
    colors: [deepPurple, lightPurple],
  );

  static const LinearGradient nightSkyGradient = LinearGradient(
    begin: Alignment.topCenter,
    end: Alignment.bottomCenter,
    colors: [Color(0xFF0F0C29), Color(0xFF302B63), Color(0xFF24243E)],
  );

  static const LinearGradient goldGradient = LinearGradient(
    colors: [Color(0xFFFFD700), Color(0xFFFFA000)],
  );

  static const LinearGradient xpGradient = LinearGradient(
    colors: [Color(0xFF4FC3F7), Color(0xFF6C63FF)],
  );

  // Shadows
  static List<BoxShadow> glowShadow(
    Color color, {
    double blur = 20,
    double spread = 0,
  }) {
    return [
      BoxShadow(
        color: color.withOpacity(0.3),
        blurRadius: blur,
        spreadRadius: spread,
      ),
    ];
  }

  static ThemeData get darkTheme {
    return ThemeData(
      brightness: Brightness.dark,
      scaffoldBackgroundColor: darkBackground,
      primaryColor: primaryPurple,
      colorScheme: const ColorScheme.dark(
        primary: primaryPurple,
        secondary: goldAccent,
        surface: surfaceColor,
        onPrimary: Colors.white,
        onSecondary: Colors.black,
        onSurface: textPrimary,
      ),
      appBarTheme: const AppBarTheme(
        backgroundColor: Colors.transparent,
        elevation: 0,
        centerTitle: true,
        titleTextStyle: TextStyle(
          color: goldAccent,
          fontSize: 20,
          fontWeight: FontWeight.bold,
        ),
      ),
      elevatedButtonTheme: ElevatedButtonThemeData(
        style: ElevatedButton.styleFrom(
          backgroundColor: goldAccent,
          foregroundColor: Colors.black,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(16),
          ),
          padding: const EdgeInsets.symmetric(vertical: 16, horizontal: 24),
          textStyle: const TextStyle(
            fontWeight: FontWeight.bold,
            fontSize: 16,
          ),
          elevation: 8,
          shadowColor: goldAccent.withOpacity(0.4),
        ),
      ),
      cardTheme: CardThemeData(
        color: cardColor,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(20),
        ),
        elevation: 8,
      ),
      snackBarTheme: SnackBarThemeData(
        backgroundColor: surfaceColor,
        contentTextStyle: const TextStyle(color: textPrimary),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(12),
        ),
        behavior: SnackBarBehavior.floating,
      ),
    );
  }
}
