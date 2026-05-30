import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:ofarin/l10n/app_localizations.dart';
import 'package:supabase_flutter/supabase_flutter.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../../../constants/app_colors.dart';
import '../../../constants/app_sizes.dart';
import '../../../routing/route_constants.dart';
import '../data/auth_repository.dart';
import '../domain/auth_state.dart';

class PinCodeScreen extends ConsumerStatefulWidget {
  const PinCodeScreen({super.key});

  @override
  ConsumerState<PinCodeScreen> createState() => _PinCodeScreenState();
}

class _PinCodeScreenState extends ConsumerState<PinCodeScreen> with SingleTickerProviderStateMixin {
  late AnimationController _shakeController;
  late Animation<double> _shakeAnimation;

  String _pin = '';
  String _firstPin = ''; // Used for confirming new pin
  bool _isCreating = false;
  bool _isConfirming = false;
  bool _isLoading = true;
  String _headerText = '';

  @override
  void initState() {
    super.initState();
    _shakeController = AnimationController(
      duration: const Duration(milliseconds: 500),
      vsync: this,
    );
    _shakeAnimation = Tween<double>(begin: 0.0, end: 24.0)
        .chain(CurveTween(curve: Curves.elasticIn))
        .animate(_shakeController);

    _checkPinStatus();
  }

  @override
  void dispose() {
    _shakeController.dispose();
    super.dispose();
  }

  // Determine if parent already has a PIN code
  void _checkPinStatus() async {
    final authState = ref.read(authStateProvider);
    if (authState is AuthAuthenticated) {
      final parentId = authState.profile.id;
      final authRepo = ref.read(authRepositoryProvider);
      
      // Check if pin is set in DB or SharedPreferences
      final pinSet = await _isPinAlreadySet(parentId, authRepo);
      
      if (mounted) {
        setState(() {
          _isCreating = !pinSet;
          _isLoading = false;
          _updateHeaderText();
        });
      }
    } else {
      if (mounted) {
        context.go(RoutePaths.auth);
      }
    }
  }

  Future<bool> _isPinAlreadySet(String parentId, AuthRepository authRepo) async {
    // In mock repository or DB, we check if PIN hash exists.
    if (authRepo.isMock) {
      final prefs = await SharedPreferences.getInstance();
      return prefs.containsKey('parent_pin_hash_$parentId');
    } else {
      try {
        final client = Supabase.instance.client;
        final data = await client
            .from('profiles')
            .select('pin_hash')
            .eq('id', parentId)
            .single();
        return data['pin_hash'] != null;
      } catch (_) {
        return false;
      }
    }
  }

  void _updateHeaderText() {
    final localizations = AppLocalizations.of(context);
    final String txtPinPrompt = localizations?.pinPrompt ?? 'Введите PIN-код / Enter PIN';
    final String txtPinCreate = localizations?.pinCreatePrompt ?? 'Создайте PIN / Create PIN';

    if (_isCreating) {
      if (_isConfirming) {
        _headerText = 'Рамзи PIN-ро тасдиқ кунед\n(Confirm Parent PIN)';
      } else {
        _headerText = '$txtPinCreate\n(Create Parent PIN)';
      }
    } else {
      _headerText = '$txtPinPrompt\n(Enter Parent PIN)';
    }
  }

  void _handleNumberPress(String digit) {
    if (_pin.length >= 4) return;

    setState(() {
      _pin += digit;
    });

    if (_pin.length == 4) {
      _processPin();
    }
  }

  void _handleBackspace() {
    if (_pin.isEmpty) return;
    setState(() {
      _pin = _pin.substring(0, _pin.length - 1);
    });
  }

  void _handleClear() {
    setState(() {
      _pin = '';
    });
  }

  void _processPin() async {
    final authState = ref.read(authStateProvider);
    if (authState is! AuthAuthenticated) return;
    
    final parentId = authState.profile.id;
    final authRepo = ref.read(authRepositoryProvider);

    if (_isCreating) {
      if (!_isConfirming) {
        // First PIN entry for creation
        setState(() {
          _firstPin = _pin;
          _pin = '';
          _isConfirming = true;
          _updateHeaderText();
        });
      } else {
        // Confirmation PIN entry
        if (_pin == _firstPin) {
          // PIN matched, save it!
          await authRepo.saveParentPin(parentId, _pin);
          if (mounted) {
            ScaffoldMessenger.of(context).showSnackBar(
              const SnackBar(
                content: Text('Рамзи PIN бомуваффақият сабт шуд!'),
                backgroundColor: AppColors.success,
              ),
            );
            context.go(RoutePaths.parentDashboard);
          }
        } else {
          // PIN mismatch
          _shakeDots();
          setState(() {
            _pin = '';
            _firstPin = '';
            _isConfirming = false;
            _updateHeaderText();
          });
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(
              content: Text('Рамзҳо мувофиқат накарданд. Аз нав кӯшиш кунед.'),
              backgroundColor: AppColors.error,
            ),
          );
        }
      }
    } else {
      // Normal PIN Verification
      final isValid = await authRepo.verifyParentPin(parentId, _pin);
      if (isValid) {
        if (mounted) {
          context.go(RoutePaths.parentDashboard);
        }
      } else {
        // PIN Incorrect
        _shakeDots();
        _handleClear();
        if (mounted) {
          final localizations = AppLocalizations.of(context);
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              content: Text(localizations?.pinIncorrect ?? 'Рамзи PIN нодуруст аст!'),
              backgroundColor: AppColors.error,
            ),
          );
        }
      }
    }
  }

  void _shakeDots() {
    _shakeController.forward(from: 0.0).then((_) => _shakeController.reverse());
  }

  @override
  Widget build(BuildContext context) {
    if (_isLoading) {
      return const Scaffold(
        body: Center(
          child: CircularProgressIndicator(color: AppColors.primary),
        ),
      );
    }

    return Scaffold(
      backgroundColor: AppColors.bgLight,
      appBar: AppBar(
        backgroundColor: Colors.transparent,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios_new_rounded, color: AppColors.textPrimaryLight),
          onPressed: () {
            ref.read(appModeProvider.notifier).exitMode();
            context.go(RoutePaths.modeSelection);
          },
        ),
      ),
      body: SafeArea(
        child: SingleChildScrollView(
          child: Column(
            children: [
              const SizedBox(height: 24),
              
              // Lock icon with pulse decoration
              Container(
                width: 80,
                height: 80,
                decoration: BoxDecoration(
                  color: AppColors.primary.withOpacity(0.1),
                  shape: BoxShape.circle,
                ),
                child: const Icon(
                  Icons.lock_person_rounded,
                  size: 40,
                  color: AppColors.primary,
                ),
              ),
              const SizedBox(height: 24),

              // Header Instructions Text
              Text(
                _headerText,
                textAlign: TextAlign.center,
                style: const TextStyle(
                  fontSize: 20,
                  fontWeight: FontWeight.bold,
                  color: AppColors.textPrimaryLight,
                  height: 1.4,
                ),
              ),
              const SizedBox(height: 32),

              // PIN Dots Indicator (with Shake Animation)
              AnimatedBuilder(
                animation: _shakeAnimation,
                builder: (context, child) {
                  return Transform.translate(
                    offset: Offset(_shakeAnimation.value, 0.0),
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: List.generate(4, (index) {
                        final isFilled = index < _pin.length;
                        return AnimatedContainer(
                          duration: const Duration(milliseconds: 150),
                          margin: const EdgeInsets.symmetric(horizontal: 12),
                          width: 20,
                          height: 20,
                          decoration: BoxDecoration(
                            color: isFilled ? AppColors.primary : Colors.white,
                            shape: BoxShape.circle,
                            border: Border.all(
                              color: isFilled ? AppColors.primary : AppColors.borderLight,
                              width: 2,
                            ),
                            boxShadow: isFilled
                                ? [
                                    BoxShadow(
                                      color: AppColors.primary.withOpacity(0.4),
                                      blurRadius: 8,
                                      offset: const Offset(0, 2),
                                    )
                                  ]
                                : [],
                          ),
                        );
                      }),
                    ),
                  );
                },
              ),
              
              const SizedBox(height: 32),

              // Custom Keypad (3x4 Grid)
              Container(
                padding: const EdgeInsets.symmetric(horizontal: AppSizes.xxl, vertical: AppSizes.l),
                decoration: const BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.only(
                    topLeft: Radius.circular(AppSizes.radiusXL),
                    topRight: Radius.circular(AppSizes.radiusXL),
                  ),
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black12,
                      blurRadius: 20,
                      offset: Offset(0, -5),
                    )
                  ],
                ),
                child: Column(
                  children: [
                    const SizedBox(height: AppSizes.l),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: ['1', '2', '3'].map((n) => _buildKeypadButton(n)).toList(),
                    ),
                    AppSizes.spaceL,
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: ['4', '5', '6'].map((n) => _buildKeypadButton(n)).toList(),
                    ),
                    AppSizes.spaceL,
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: ['7', '8', '9'].map((n) => _buildKeypadButton(n)).toList(),
                    ),
                    AppSizes.spaceL,
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        // Clear button
                        _buildActionButton(
                          icon: Icons.refresh_rounded,
                          onPressed: _handleClear,
                        ),
                        // Zero key
                        _buildKeypadButton('0'),
                        // Backspace button
                        _buildActionButton(
                          icon: Icons.backspace_outlined,
                          onPressed: _handleBackspace,
                        ),
                      ],
                    ),
                    const SizedBox(height: AppSizes.xl),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildKeypadButton(String digit) {
    return InkWell(
      onTap: () => _handleNumberPress(digit),
      borderRadius: BorderRadius.circular(40),
      child: Container(
        width: 72,
        height: 72,
        decoration: BoxDecoration(
          color: AppColors.bgLight,
          shape: BoxShape.circle,
          border: Border.all(color: AppColors.borderLight, width: 1),
        ),
        alignment: Alignment.center,
        child: Text(
          digit,
          style: const TextStyle(
            fontSize: 28,
            fontWeight: FontWeight.w700,
            color: AppColors.textPrimaryLight,
          ),
        ),
      ),
    );
  }

  Widget _buildActionButton({required IconData icon, required VoidCallback onPressed}) {
    return InkWell(
      onTap: onPressed,
      borderRadius: BorderRadius.circular(40),
      child: Container(
        width: 72,
        height: 72,
        alignment: Alignment.center,
        child: Icon(
          icon,
          size: 28,
          color: AppColors.textSecondaryLight,
        ),
      ),
    );
  }
}
