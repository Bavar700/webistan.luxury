import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:ofarin/l10n/app_localizations.dart';
import '../../../constants/app_colors.dart';
import '../../../routing/route_constants.dart';
import '../../auth/data/auth_repository.dart';
import '../../auth/domain/auth_state.dart';
import 'add_child_dialog.dart';

class ParentDashboardScreen extends ConsumerStatefulWidget {
  const ParentDashboardScreen({super.key});

  @override
  ConsumerState<ParentDashboardScreen> createState() =>
      _ParentDashboardScreenState();
}

class _ParentDashboardScreenState extends ConsumerState<ParentDashboardScreen> {
  bool _isReloading = false;

  void _reloadProfiles() {
    setState(() => _isReloading = !_isReloading);
  }

  void _openAddChildDialog(BuildContext context, String parentId) {
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (context) => AddChildDialog(
        parentId: parentId,
        onChildAdded: _reloadProfiles,
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    final authState = ref.watch(authStateProvider);
    final localizations = AppLocalizations.of(context);

    if (authState is! AuthAuthenticated) {
      return const Scaffold(body: Center(child: CircularProgressIndicator()));
    }

    final parent = authState.profile;
    final authRepo = ref.read(authRepositoryProvider);
    final String txtAddChild = localizations?.addChild ?? 'Иловаи Кӯдак';
    final String txtNoChildren =
        localizations?.noChildren ?? 'Кӯдак илова нашудааст';

    return Scaffold(
      body: Container(
        decoration: const BoxDecoration(gradient: AppColors.childBgGradient),
        child: SafeArea(
          child: Column(
            children: [
              // ===== HEADER =====
              Container(
                padding: const EdgeInsets.fromLTRB(20, 16, 20, 28),
                decoration: const BoxDecoration(
                  gradient: AppColors.primaryGradient,
                  borderRadius:
                      BorderRadius.vertical(bottom: Radius.circular(32)),
                ),
                child: Column(
                  children: [
                    Row(
                      children: [
                        // Back
                        GestureDetector(
                          onTap: () {
                            ref.read(appModeProvider.notifier).exitMode();
                            context.go(RoutePaths.modeSelection);
                          },
                          child: Container(
                            padding: const EdgeInsets.symmetric(
                                horizontal: 12, vertical: 8),
                            decoration: BoxDecoration(
                              color: Colors.white.withOpacity(0.2),
                              borderRadius: BorderRadius.circular(14),
                            ),
                            child: const Row(
                              children: [
                                Icon(Icons.arrow_back_ios_new_rounded,
                                    color: Colors.white, size: 14),
                                SizedBox(width: 4),
                                Text('Баромадан',
                                    style: TextStyle(
                                        color: Colors.white,
                                        fontWeight: FontWeight.bold,
                                        fontSize: 13)),
                              ],
                            ),
                          ),
                        ),
                        const Spacer(),
                        // Add child
                        GestureDetector(
                          onTap: () => _openAddChildDialog(context, parent.id),
                          child: Container(
                            padding: const EdgeInsets.all(10),
                            decoration: BoxDecoration(
                              color: Colors.white.withOpacity(0.2),
                              shape: BoxShape.circle,
                            ),
                            child: const Icon(Icons.person_add_rounded,
                                color: Colors.white, size: 22),
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 20),
                    const Text('👨‍👩‍👧', style: TextStyle(fontSize: 48)),
                    const SizedBox(height: 8),
                    Text(
                      parent.displayName,
                      style: const TextStyle(
                        fontSize: 22,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                    const Text(
                      'Панели Волидайн 🏠',
                      style: TextStyle(color: Colors.white70, fontSize: 14),
                    ),
                    const SizedBox(height: 20),
                    // Stats row
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceAround,
                      children: [
                        _buildStat('14', '✅', 'Вазифаҳо'),
                        _buildStat('360', '⭐', 'Ситораҳо'),
                        _buildStat('2', '🔔', 'Интизорӣ'),
                      ],
                    ),
                  ],
                ),
              ),

              // ===== QUICK ACTIONS =====
              Padding(
                padding: const EdgeInsets.fromLTRB(20, 20, 20, 0),
                child: Row(
                  children: [
                    _QuickAction(
                      emoji: '📋',
                      label: 'Вазифаҳо',
                      color: AppColors.primary,
                      onTap: () => context.go(RoutePaths.parentTaskConfig),
                    ),
                    const SizedBox(width: 12),
                    _QuickAction(
                      emoji: '💹',
                      label: 'Иқтисодиёт',
                      color: AppColors.funGreen,
                      onTap: () => context.go(RoutePaths.parentLedger),
                    ),
                    const SizedBox(width: 12),
                    _QuickAction(
                      emoji: '🎁',
                      label: 'Орзуҳо',
                      color: AppColors.funPink,
                      onTap: () =>
                          context.go(RoutePaths.parentWishlistApproval),
                    ),
                  ],
                ),
              ),

              const SizedBox(height: 20),

              // ===== CHILDREN LIST =====
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 20),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    const Text(
                      '👧 Фарзандони ман',
                      style: TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.bold,
                          color: AppColors.textPrimaryLight),
                    ),
                    GestureDetector(
                      onTap: () => _openAddChildDialog(context, parent.id),
                      child: Container(
                        padding: const EdgeInsets.symmetric(
                            horizontal: 12, vertical: 6),
                        decoration: BoxDecoration(
                          color: AppColors.primary.withOpacity(0.1),
                          borderRadius: BorderRadius.circular(12),
                        ),
                        child: const Row(
                          children: [
                            Icon(Icons.add, color: AppColors.primary, size: 16),
                            SizedBox(width: 4),
                            Text('Иловаи',
                                style: TextStyle(
                                    color: AppColors.primary,
                                    fontWeight: FontWeight.bold,
                                    fontSize: 13)),
                          ],
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 12),

              Expanded(
                child: FutureBuilder<List<UserProfile>>(
                  key: ValueKey(_isReloading),
                  future: authRepo.fetchChildren(parent.id),
                  builder: (context, snapshot) {
                    if (snapshot.connectionState == ConnectionState.waiting) {
                      return const Center(
                          child: CircularProgressIndicator(
                              color: AppColors.primary));
                    }

                    if (snapshot.hasError) {
                      return Center(
                        child: Text('Хатогӣ: ${snapshot.error}',
                            style: const TextStyle(color: AppColors.error)),
                      );
                    }

                    final children = snapshot.data ?? [];

                    if (children.isEmpty) {
                      return Center(
                        child: Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            const Text('👶',
                                style: TextStyle(fontSize: 64)),
                            const SizedBox(height: 16),
                            Text(
                              txtNoChildren,
                              style: const TextStyle(
                                  fontSize: 16,
                                  color: AppColors.textSecondaryLight),
                            ),
                            const SizedBox(height: 16),
                            ElevatedButton.icon(
                              onPressed: () =>
                                  _openAddChildDialog(context, parent.id),
                              icon: const Icon(Icons.add),
                              label: Text(txtAddChild),
                            ),
                          ],
                        ),
                      );
                    }

                    return ListView.separated(
                      padding: const EdgeInsets.symmetric(horizontal: 20),
                      itemCount: children.length,
                      separatorBuilder: (_, __) => const SizedBox(height: 14),
                      itemBuilder: (context, i) {
                        return _ChildCard(
                          child: children[i],
                          onTasksTap: () =>
                              context.go(RoutePaths.parentTaskConfig),
                          onLedgerTap: () =>
                              context.go(RoutePaths.parentLedger),
                          onWishlistTap: () =>
                              context.go(RoutePaths.parentWishlistApproval),
                        );
                      },
                    );
                  },
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildStat(String value, String emoji, String label) {
    return Column(
      children: [
        Row(
          children: [
            Text(emoji, style: const TextStyle(fontSize: 16)),
            const SizedBox(width: 4),
            Text(value,
                style: const TextStyle(
                    color: Colors.white,
                    fontSize: 20,
                    fontWeight: FontWeight.bold)),
          ],
        ),
        Text(label,
            style: const TextStyle(color: Colors.white60, fontSize: 11)),
      ],
    );
  }
}

class _QuickAction extends StatelessWidget {
  final String emoji;
  final String label;
  final Color color;
  final VoidCallback onTap;

  const _QuickAction({
    required this.emoji,
    required this.label,
    required this.color,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return Expanded(
      child: GestureDetector(
        onTap: onTap,
        child: Container(
          padding: const EdgeInsets.symmetric(vertical: 16),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(18),
            boxShadow: [
              BoxShadow(
                color: color.withOpacity(0.15),
                blurRadius: 12,
                offset: const Offset(0, 4),
              )
            ],
          ),
          child: Column(
            children: [
              Text(emoji, style: const TextStyle(fontSize: 28)),
              const SizedBox(height: 6),
              Text(
                label,
                style: TextStyle(
                    fontSize: 12,
                    fontWeight: FontWeight.bold,
                    color: color),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class _ChildCard extends StatelessWidget {
  final UserProfile child;
  final VoidCallback onTasksTap;
  final VoidCallback onLedgerTap;
  final VoidCallback onWishlistTap;

  const _ChildCard({
    required this.child,
    required this.onTasksTap,
    required this.onLedgerTap,
    required this.onWishlistTap,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(24),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.06),
            blurRadius: 16,
            offset: const Offset(0, 6),
          )
        ],
      ),
      child: Column(
        children: [
          // Child info
          Padding(
            padding: const EdgeInsets.all(18),
            child: Row(
              children: [
                Container(
                  width: 60,
                  height: 60,
                  decoration: BoxDecoration(
                    gradient: AppColors.primaryGradient,
                    shape: BoxShape.circle,
                  ),
                  child: Center(
                    child: Text(child.avatarUrl ?? '🦊',
                        style: const TextStyle(fontSize: 30)),
                  ),
                ),
                const SizedBox(width: 16),
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        child.displayName,
                        style: const TextStyle(
                            fontSize: 18,
                            fontWeight: FontWeight.bold,
                            color: AppColors.textPrimaryLight),
                      ),
                      const SizedBox(height: 4),
                      Row(
                        children: [
                          Container(
                            padding: const EdgeInsets.symmetric(
                                horizontal: 8, vertical: 3),
                            decoration: BoxDecoration(
                              color: Colors.orange.shade50,
                              borderRadius: BorderRadius.circular(8),
                            ),
                            child: Text(
                              '🔥 ${child.streakCount} рӯз',
                              style: TextStyle(
                                  fontSize: 11,
                                  fontWeight: FontWeight.bold,
                                  color: Colors.orange.shade700),
                            ),
                          ),
                          const SizedBox(width: 8),
                          const Text('•  2 фаъол',
                              style: TextStyle(
                                  fontSize: 12,
                                  color: AppColors.textSecondaryLight)),
                        ],
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),

          // Balance row
          Container(
            margin: const EdgeInsets.symmetric(horizontal: 18),
            padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
            decoration: BoxDecoration(
              color: AppColors.bgLight,
              borderRadius: BorderRadius.circular(14),
            ),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceAround,
              children: [
                _balanceItem('⭐', '${child.starsBalance}', 'Ситораҳо'),
                Container(
                    width: 1,
                    height: 28,
                    color: AppColors.borderLight),
                _balanceItem('💰',
                    '${child.fiatBalance.toStringAsFixed(2)} с.', 'Сомонӣ'),
              ],
            ),
          ),
          const SizedBox(height: 12),

          // Action buttons
          Padding(
            padding: const EdgeInsets.fromLTRB(12, 0, 12, 14),
            child: Row(
              children: [
                _actionBtn('📋', 'Вазифаҳо', AppColors.primary, onTasksTap),
                const SizedBox(width: 8),
                _actionBtn('💹', 'Иқтисодиёт', AppColors.funGreen, onLedgerTap),
                const SizedBox(width: 8),
                _actionBtn('🎁', 'Орзуҳо', AppColors.funPink, onWishlistTap),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _balanceItem(String emoji, String val, String label) {
    return Column(
      children: [
        Row(children: [
          Text(emoji, style: const TextStyle(fontSize: 16)),
          const SizedBox(width: 4),
          Text(val,
              style: const TextStyle(
                  fontWeight: FontWeight.bold, fontSize: 14)),
        ]),
        Text(label,
            style: const TextStyle(
                fontSize: 10, color: AppColors.textSecondaryLight)),
      ],
    );
  }

  Widget _actionBtn(
      String emoji, String label, Color color, VoidCallback onTap) {
    return Expanded(
      child: GestureDetector(
        onTap: onTap,
        child: Container(
          padding: const EdgeInsets.symmetric(vertical: 10),
          decoration: BoxDecoration(
            color: color.withOpacity(0.1),
            borderRadius: BorderRadius.circular(12),
          ),
          child: Column(
            children: [
              Text(emoji, style: const TextStyle(fontSize: 20)),
              const SizedBox(height: 3),
              Text(label,
                  style: TextStyle(
                      fontSize: 10, fontWeight: FontWeight.bold, color: color)),
            ],
          ),
        ),
      ),
    );
  }
}
