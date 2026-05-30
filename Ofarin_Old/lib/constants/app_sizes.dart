import 'package:flutter/material.dart';

class AppSizes {
  AppSizes._();

  // Spacing / Padding Sizes
  static const double xs = 4.0;
  static const double s = 8.0;
  static const double m = 12.0;
  static const double l = 16.0;
  static const double xl = 24.0;
  static const double xxl = 32.0;
  static const double xxxl = 48.0;

  // Spacing Widgets (SizedBox helpers)
  static const SizedBox spaceXS = SizedBox(width: xs, height: xs);
  static const SizedBox spaceS = SizedBox(width: s, height: s);
  static const SizedBox spaceM = SizedBox(width: m, height: m);
  static const SizedBox spaceL = SizedBox(width: l, height: l);
  static const SizedBox spaceXL = SizedBox(width: xl, height: xl);
  static const SizedBox spaceXXL = SizedBox(width: xxl, height: xxl);

  // Border Radii (Highly rounded, bubble/pill aesthetic for children)
  static const double radiusS = 8.0;
  static const double radiusM = 16.0;
  static const double radiusL = 24.0;
  static const double radiusXL = 32.0;
  static const double radiusPill = 999.0;

  static final BorderRadius borderRadiusS = BorderRadius.circular(radiusS);
  static final BorderRadius borderRadiusM = BorderRadius.circular(radiusM);
  static final BorderRadius borderRadiusL = BorderRadius.circular(radiusL);
  static final BorderRadius borderRadiusXL = BorderRadius.circular(radiusXL);
  static final BorderRadius borderRadiusPill = BorderRadius.circular(radiusPill);

  // Elevation / Shadow Values
  static const double elevationNone = 0.0;
  static const double elevationLow = 2.0;
  static const double elevationMedium = 6.0;
  static const double elevationHigh = 12.0;

  // UI Component Heights/Widths
  static const double buttonHeight = 56.0;
  static const double inputHeight = 56.0;
  static const double iconSizeS = 18.0;
  static const double iconSizeM = 24.0;
  static const double iconSizeL = 32.0;
  static const double avatarSizeS = 40.0;
  static const double avatarSizeM = 60.0;
  static const double avatarSizeL = 80.0;
}
