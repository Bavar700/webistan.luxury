// ══════════════════════════════════════════════════════════════════════════════
// Snackbar Helper — Reusable snackbar utility for consistent UX
// ══════════════════════════════════════════════════════════════════════════════

import 'package:flutter/material.dart';
import '../theme/app_colors.dart';

enum SnackbarType { success, error, warning, info }

class SnackbarHelper {
  SnackbarHelper._();

  static void show({
    required BuildContext context,
    required String message,
    SnackbarType type = SnackbarType.info,
    String? actionLabel,
    VoidCallback? onAction,
    Duration duration = const Duration(seconds: 4),
  }) {
    final color = _getColor(type);
    final icon = _getIcon(type);

    ScaffoldMessenger.of(context)
      ..hideCurrentSnackBar()
      ..showSnackBar(
        SnackBar(
          content: Row(
            children: [
              Icon(icon, color: Colors.white, size: 20),
              const SizedBox(width: 12),
              Expanded(
                child: Text(
                  message,
                  style: const TextStyle(
                    color: Colors.white,
                    fontSize: 14,
                    fontWeight: FontWeight.w500,
                  ),
                ),
              ),
            ],
          ),
          backgroundColor: color,
          behavior: SnackBarBehavior.floating,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(12),
          ),
          margin: const EdgeInsets.fromLTRB(16, 0, 16, 20),
          padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
          duration: duration,
          action: actionLabel != null
              ? SnackBarAction(
                  label: actionLabel,
                  textColor: Colors.white,
                  onPressed: onAction ?? () {},
                )
              : null,
        ),
      );
  }

  static void showSuccess(BuildContext context, String message) {
    show(context: context, message: message, type: SnackbarType.success);
  }

  static void showError(BuildContext context, String message) {
    show(context: context, message: message, type: SnackbarType.error);
  }

  static void showWarning(BuildContext context, String message) {
    show(context: context, message: message, type: SnackbarType.warning);
  }

  static void showInfo(BuildContext context, String message) {
    show(context: context, message: message, type: SnackbarType.info);
  }

  static Color _getColor(SnackbarType type) {
    switch (type) {
      case SnackbarType.success:
        return AppColors.success;
      case SnackbarType.error:
        return AppColors.error;
      case SnackbarType.warning:
        return AppColors.warning;
      case SnackbarType.info:
        return AppColors.accent;
    }
  }

  static IconData _getIcon(SnackbarType type) {
    switch (type) {
      case SnackbarType.success:
        return Icons.check_circle;
      case SnackbarType.error:
        return Icons.error_outline;
      case SnackbarType.warning:
        return Icons.warning_amber;
      case SnackbarType.info:
        return Icons.info_outline;
    }
  }
}

extension SnackbarContextX on BuildContext {
  void showSuccess(String message) =>
      SnackbarHelper.showSuccess(this, message);

  void showError(String message) =>
      SnackbarHelper.showError(this, message);

  void showWarning(String message) =>
      SnackbarHelper.showWarning(this, message);

  void showInfo(String message) =>
      SnackbarHelper.showInfo(this, message);
}
