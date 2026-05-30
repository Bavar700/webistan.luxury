import 'dart:async';
import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:confetti/confetti.dart';
import 'package:ofarin/l10n/app_localizations.dart';
import '../../../constants/app_colors.dart';
import '../../../constants/app_sizes.dart';
import '../../../routing/route_constants.dart';
import '../data/task_repository.dart';

class ChildTimerScreen extends ConsumerStatefulWidget {
  final Map<String, dynamic> timerData;

  const ChildTimerScreen({
    super.key,
    required this.timerData,
  });

  @override
  ConsumerState<ChildTimerScreen> createState() => _ChildTimerScreenState();
}

class _ChildTimerScreenState extends ConsumerState<ChildTimerScreen> with WidgetsBindingObserver {
  late ConfettiController _confettiController;
  Timer? _timer;
  
  late String _taskId;
  late String _taskTitle;
  late int _totalSeconds;
  late DateTime _startTime;
  
  int _secondsRemaining = 0;
  bool _isFinished = false;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addObserver(this);
    _confettiController = ConfettiController(duration: const Duration(seconds: 4));
    
    // Parse arguments
    _taskId = widget.timerData['taskId'] as String? ?? '';
    _taskTitle = widget.timerData['title'] as String? ?? 'Вазифаи таймерӣ';
    _totalSeconds = widget.timerData['duration'] as int? ?? 1200; // Default 20 mins
    _secondsRemaining = _totalSeconds;
    _startTime = DateTime.now();
    
    _startTimer(); // Auto-start lock timer
  }

  @override
  void dispose() {
    WidgetsBinding.instance.removeObserver(this);
    _timer?.cancel();
    _confettiController.dispose();
    super.dispose();
  }

  @override
  void didChangeAppLifecycleState(AppLifecycleState state) {
    if (state == AppLifecycleState.resumed && !_isFinished) {
      final elapsed = DateTime.now().difference(_startTime).inSeconds;
      final remaining = _totalSeconds - elapsed;
      setState(() {
        if (remaining <= 0) {
          _secondsRemaining = 0;
          _completeTimer();
        } else {
          _secondsRemaining = remaining;
        }
      });
    }
  }

  void _startTimer() {
    if (_timer != null) return;

    _timer = Timer.periodic(const Duration(seconds: 1), (timer) {
      if (_secondsRemaining > 0) {
        setState(() {
          _secondsRemaining--;
        });
      } else {
        _completeTimer();
      }
    });
  }

  void _completeTimer() async {
    _timer?.cancel();
    _timer = null;
    
    final taskRepo = ref.read(taskRepositoryProvider);
    try {
      await taskRepo.updateTaskStatus(
        _taskId,
        'done_pending_approval',
        submissionComment: 'Супориши таймерӣ бомуваффақият иҷро шуд! ⏳',
      );
    } catch (_) {}

    setState(() {
      _isFinished = true;
    });

    _confettiController.play();
  }

  String _formatDuration(int totalSecs) {
    final mins = (totalSecs / 60).toInt();
    final secs = totalSecs % 60;
    return '${mins.toString().padLeft(2, '0')}:${secs.toString().padLeft(2, '0')}';
  }

  @override
  Widget build(BuildContext context) {
    final localizations = AppLocalizations.of(context);
    final progress = _totalSeconds > 0 ? (_secondsRemaining / _totalSeconds) : 0.0;

    final String txtWarning = localizations?.timerLockWarning ?? 'Супориш фаъол аст! Барномаро маҳкам накунед!';
    final String txtFinished = localizations?.timerFinished ?? 'Таймер ба охир расид!';
    final String txtWellDone = localizations?.wellDone ?? 'Офарин! Аъло!';
    final String txtDesc = localizations?.taskSentReviewDesc ?? 'Вазифа барои тасдиқ фиристода шуд.';

    return PopScope(
      // PopScope blocks system back presses unless task timer is finished.
      canPop: _isFinished,
      onPopInvokedWithResult: (didPop, result) {
        if (!didPop) {
          // Alert prompt if user tries to swipe/back out early
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              content: Text(txtWarning),
              backgroundColor: AppColors.error,
              behavior: SnackBarBehavior.floating,
              duration: const Duration(seconds: 2),
            ),
          );
        }
      },
      child: Scaffold(
        backgroundColor: const Color(0xFF0F172A), // Focused midnight dark background
        body: Stack(
          alignment: Alignment.center,
          children: [
            // Decorative background radial circles
            Positioned(
              top: -100,
              child: Container(
                width: 300,
                height: 300,
                decoration: BoxDecoration(
                  color: Colors.purple.withOpacity(0.08),
                  shape: BoxShape.circle,
                ),
              ),
            ),

            SafeArea(
              child: Padding(
                padding: const EdgeInsets.all(AppSizes.xl),
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    // Task title context header
                    Text(
                      _taskTitle,
                      textAlign: TextAlign.center,
                      style: const TextStyle(
                        fontSize: 22,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                    const SizedBox(height: 12),
                    
                    // Task timer warning message
                    Text(
                      _isFinished ? txtFinished : txtWarning,
                      textAlign: TextAlign.center,
                      style: TextStyle(
                        fontSize: 13,
                        fontWeight: FontWeight.w600,
                        color: _isFinished ? AppColors.success : Colors.redAccent,
                      ),
                    ),
                    
                    const Spacer(),

                    // Circular Countdown Timer Widget
                    Stack(
                      alignment: Alignment.center,
                      children: [
                        // Outer progress track ring
                        SizedBox(
                          width: 240,
                          height: 240,
                          child: CircularProgressIndicator(
                            value: progress,
                            strokeWidth: 14,
                            backgroundColor: Colors.white10,
                            color: _isFinished ? AppColors.success : Colors.purpleAccent,
                          ),
                        ),
                        // Inner MM:SS Text
                        Column(
                          mainAxisSize: MainAxisSize.min,
                          children: [
                            Text(
                              _formatDuration(_secondsRemaining),
                              style: const TextStyle(
                                fontSize: 44,
                                fontWeight: FontWeight.bold,
                                color: Colors.white,
                                fontFamily: 'monospace',
                              ),
                            ),
                            if (_isFinished) ...[
                              const SizedBox(height: 6),
                              const Icon(
                                Icons.emoji_events_rounded,
                                color: AppColors.accent,
                                size: 36,
                              ),
                            ],
                          ],
                        ),
                      ],
                    ),

                    const Spacer(),

                    // Completion actions block
                    if (_isFinished) ...[
                      // Celebratory texts
                      Text(
                        txtWellDone,
                        style: const TextStyle(
                          fontSize: 24,
                          fontWeight: FontWeight.bold,
                          color: AppColors.accent,
                        ),
                      ),
                      const SizedBox(height: 8),
                      Text(
                        txtDesc,
                        textAlign: TextAlign.center,
                        style: const TextStyle(color: Colors.white70, fontSize: 14),
                      ),
                      AppSizes.spaceXL,
                      // Return button
                      Container(
                        height: 52,
                        width: double.infinity,
                        decoration: BoxDecoration(
                          gradient: AppColors.successGradient,
                          borderRadius: AppSizes.borderRadiusM,
                        ),
                        child: ElevatedButton(
                          onPressed: () {
                            context.go('${RoutePaths.childDashboard}/${RoutePaths.childTasks}');
                          },
                          style: ElevatedButton.styleFrom(
                            backgroundColor: Colors.transparent,
                            shadowColor: Colors.transparent,
                            elevation: 0,
                          ),
                          child: const Text(
                            'Ба вазифаҳо баргаштан',
                            style: TextStyle(fontWeight: FontWeight.bold, color: Colors.white, fontSize: 16),
                          ),
                        ),
                      ),
                    ] else ...[
                      // Muted instructions while locked
                      const Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Icon(Icons.lock_rounded, color: Colors.white38, size: 16),
                          SizedBox(width: 8),
                          Text(
                            'Навигатсия қуфл аст (Timer Lock Active)',
                            style: TextStyle(color: Colors.white38, fontSize: 12),
                          ),
                        ],
                      ),
                    ],
                  ],
                ),
              ),
            ),

            // Confetti emitter (anchored in center top for celebratory drops)
            Align(
              alignment: Alignment.topCenter,
              child: ConfettiWidget(
                confettiController: _confettiController,
                blastDirectionality: BlastDirectionality.explosive,
                shouldLoop: false,
                colors: const [
                  Colors.green,
                  Colors.blue,
                  Colors.pink,
                  Colors.orange,
                  Colors.purple,
                  Colors.yellow,
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
