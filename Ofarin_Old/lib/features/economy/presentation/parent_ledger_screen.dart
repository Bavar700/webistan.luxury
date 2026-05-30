import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:go_router/go_router.dart';
import 'package:ofarin/l10n/app_localizations.dart';
import '../../../constants/app_colors.dart';
import '../../../constants/app_sizes.dart';
import '../../../routing/route_constants.dart';
import '../../auth/data/auth_repository.dart';
import '../../auth/domain/auth_state.dart';
import '../data/economy_repository.dart';

class ParentLedgerScreen extends ConsumerStatefulWidget {
  const ParentLedgerScreen({super.key});

  @override
  ConsumerState<ParentLedgerScreen> createState() => _ParentLedgerScreenState();
}

class _ParentLedgerScreenState extends ConsumerState<ParentLedgerScreen> {
  final _formKey = GlobalKey<FormState>();
  final _amountController = TextEditingController();
  final _descController = TextEditingController();

  UserProfile? _selectedChild;
  String _currencyType = 'stars';
  bool _isReloading = false;
  bool _showAdjustmentForm = false;
  bool _isSaving = false;

  @override
  void dispose() {
    _amountController.dispose();
    _descController.dispose();
    super.dispose();
  }

  void _reloadLedger() {
    setState(() {
      _isReloading = !_isReloading;
    });
  }

  void _submitAdjustment(String parentId) async {
    if (!_formKey.currentState!.validate() || _selectedChild == null) return;

    setState(() {
      _isSaving = true;
    });

    final economyRepo = ref.read(economyRepositoryProvider);
    final amount = double.tryParse(_amountController.text) ?? 0.0;
    final desc = _descController.text.trim().isEmpty 
        ? 'Танзими дастӣ' 
        : _descController.text.trim();

    try {
      await economyRepo.logManualAdjustment(
        _selectedChild!.id,
        parentId,
        amount,
        _currencyType,
        desc,
      );

      // Force reload of parent profile state in Provider to update dashboard balances
      ref.read(authStateProvider.notifier).loadProfile(parentId);

      _amountController.clear();
      _descController.clear();
      
      setState(() {
        _showAdjustmentForm = false;
      });
      _reloadLedger();

      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('Тавозун бомуваффақият тағйир ёфт!'),
            backgroundColor: AppColors.success,
          ),
        );
      }
    } catch (e) {
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text('Хатогӣ: $e'), backgroundColor: AppColors.error),
        );
      }
    } finally {
      setState(() {
        _isSaving = false;
      });
    }
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
    final economyRepo = ref.read(economyRepositoryProvider);

    final String txtLedger = localizations?.ledgerAudits ?? 'Ҳисоботи молиявӣ';
    final String txtAdjust = localizations?.adjustBalance ?? 'Тағйири тавозун';
    final String txtSave = localizations?.save ?? 'Сабт';
    final String txtCancel = localizations?.cancel ?? 'Баргаштан';

    return Scaffold(
      backgroundColor: AppColors.bgLight,
      appBar: AppBar(
        title: Text(txtLedger),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios_new_rounded),
          onPressed: () => context.go(RoutePaths.parentDashboard),
        ),
      ),
      body: SafeArea(
        child: FutureBuilder<List<UserProfile>>(
          future: authRepo.fetchChildren(parent.id),
          builder: (context, childSnapshot) {
            if (childSnapshot.connectionState == ConnectionState.waiting) {
              return const Center(child: CircularProgressIndicator(color: AppColors.primary));
            }

            final children = childSnapshot.data ?? [];
            if (children.isEmpty) {
              return _buildNoChildrenState(context);
            }

            _selectedChild ??= children.first;

            return Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                // 1. Child Selection Dropdown Header
                _buildChildSelector(children),

                // 2. Child Wallet Mini Info card
                _buildChildMiniWallet(),

                // 3. Transactions & Manual Form Layout
                Expanded(
                  child: ListView(
                    padding: const EdgeInsets.all(AppSizes.l),
                    children: [
                      // Manual adjustment button toggle
                      OutlinedButton.icon(
                        onPressed: () => setState(() => _showAdjustmentForm = !_showAdjustmentForm),
                        icon: Icon(_showAdjustmentForm ? Icons.remove : Icons.add, size: 16),
                        label: Text(txtAdjust),
                        style: OutlinedButton.styleFrom(
                          foregroundColor: AppColors.primary,
                          side: const BorderSide(color: AppColors.primary, width: 1.2),
                          shape: RoundedRectangleBorder(borderRadius: AppSizes.borderRadiusM),
                          padding: const EdgeInsets.symmetric(vertical: 12),
                        ),
                      ),
                      
                      // Manual Adjustment Card Form
                      if (_showAdjustmentForm) ...[
                        AppSizes.spaceM,
                        _buildManualAdjustmentCard(parent.id, txtSave, txtCancel),
                      ],

                      AppSizes.spaceXL,

                      // Section Header: Transaction Ledger
                      const Text(
                        'Дафтари даромад ва хароҷот (Ledger Entries)',
                        style: TextStyle(fontWeight: FontWeight.bold, fontSize: 14, color: AppColors.textSecondaryLight),
                      ),
                      const SizedBox(height: AppSizes.s),

                      // History Loader
                      FutureBuilder<List<TransactionModel>>(
                        key: ValueKey('${_selectedChild!.id}_$_isReloading'),
                        future: economyRepo.fetchTransactions(_selectedChild!.id),
                        builder: (context, ledgerSnapshot) {
                          if (ledgerSnapshot.connectionState == ConnectionState.waiting) {
                            return const Center(
                              child: Padding(
                                padding: EdgeInsets.symmetric(vertical: 32.0),
                                child: CircularProgressIndicator(color: AppColors.primary),
                              ),
                            );
                          }

                          final txList = ledgerSnapshot.data ?? [];
                          if (txList.isEmpty) {
                            return Container(
                              padding: const EdgeInsets.all(24),
                              decoration: BoxDecoration(
                                color: Colors.white,
                                borderRadius: AppSizes.borderRadiusM,
                                border: Border.all(color: AppColors.borderLight),
                              ),
                              alignment: Alignment.center,
                              child: const Text(
                                'Ягон сабт ёфт нашуд.',
                                style: TextStyle(color: AppColors.textSecondaryLight, fontWeight: FontWeight.bold),
                              ),
                            );
                          }

                          txList.sort((a, b) => b.createdAt.compareTo(a.createdAt));

                          return Column(
                            children: txList.map((tx) => _buildLedgerItem(tx)).toList(),
                          );
                        },
                      ),
                    ],
                  ),
                ),
              ],
            );
          },
        ),
      ),
    );
  }

  Widget _buildChildSelector(List<UserProfile> children) {
    return Container(
      color: Colors.white,
      padding: const EdgeInsets.symmetric(horizontal: AppSizes.l, vertical: AppSizes.s),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          const Text(
            'Ҳисоботи кӯдак:',
            style: TextStyle(fontWeight: FontWeight.bold, color: AppColors.textSecondaryLight),
          ),
          DropdownButton<UserProfile>(
            value: _selectedChild,
            icon: const Icon(Icons.arrow_drop_down_rounded, color: AppColors.primary),
            underline: Container(),
            onChanged: (UserProfile? newVal) {
              if (newVal != null) {
                setState(() {
                  _selectedChild = newVal;
                  _showAdjustmentForm = false;
                });
              }
            },
            items: children.map<DropdownMenuItem<UserProfile>>((UserProfile child) {
              return DropdownMenuItem<UserProfile>(
                value: child,
                child: Row(
                  children: [
                    Text(child.avatarUrl ?? '🦊', style: const TextStyle(fontSize: 18)),
                    const SizedBox(width: 8),
                    Text(
                      child.displayName,
                      style: const TextStyle(fontWeight: FontWeight.bold, color: AppColors.primary),
                    ),
                  ],
                ),
              );
            }).toList(),
          ),
        ],
      ),
    );
  }

  Widget _buildChildMiniWallet() {
    if (_selectedChild == null) return Container();
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: AppSizes.xl, vertical: AppSizes.m),
      decoration: const BoxDecoration(
        color: Colors.white,
        border: Border(bottom: BorderSide(color: AppColors.borderLight, width: 1.5)),
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Row(
            children: [
              const Icon(Icons.star_rounded, color: AppColors.accent, size: 22),
              const SizedBox(width: 4),
              Text(
                '${_selectedChild!.starsBalance} хол',
                style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
              ),
            ],
          ),
          Row(
            children: [
              const Icon(Icons.account_balance_wallet_rounded, color: AppColors.success, size: 18),
              const SizedBox(width: 4),
              Text(
                '${_selectedChild!.fiatBalance.toStringAsFixed(2)} TJS',
                style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 15),
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildManualAdjustmentCard(String parentId, String txtSave, String txtCancel) {
    return Container(
      padding: const EdgeInsets.all(AppSizes.l),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: AppSizes.borderRadiusM,
        border: Border.all(color: AppColors.primary.withOpacity(0.4), width: 1.5),
      ),
      child: Form(
        key: _formKey,
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            const Text(
              'Танзимоти дастӣ (Manual Adjustment Form)',
              style: TextStyle(fontWeight: FontWeight.bold, fontSize: 13, color: AppColors.primary),
            ),
            const SizedBox(height: AppSizes.m),

            // Amount Input
            TextFormField(
              controller: _amountController,
              keyboardType: const TextInputType.numberWithOptions(signed: true, decimal: true),
              decoration: const InputDecoration(
                labelText: 'Миқдори маблағ (масалан: +5, -10)',
                prefixIcon: Icon(Icons.currency_exchange_rounded),
                helperText: 'Барои илова кардан "+" ва барои кам кардан "-" гузоред.',
              ),
              validator: (value) {
                final n = double.tryParse(value ?? '');
                if (n == null || n == 0.0) {
                  return 'Илтимос, рақами мусбат ё манфиро нависед';
                }
                return null;
              },
            ),
            AppSizes.spaceM,

            // Description Input
            TextFormField(
              controller: _descController,
              decoration: const InputDecoration(
                labelText: 'Сабаби тағйирот (Reason)',
                hintText: 'Масалан: Бонуси умумӣ, ҷарима барои кор...',
                prefixIcon: Icon(Icons.description_outlined),
              ),
              validator: (value) {
                if (value == null || value.trim().isEmpty) {
                  return 'Илтимос, сабаби тағйиротро нависед';
                }
                return null;
              },
            ),
            AppSizes.spaceM,

            // Currency & Buttons row
            Row(
              children: [
                Expanded(
                  flex: 4,
                  child: DropdownButtonFormField<String>(
                    initialValue: _currencyType,
                    decoration: const InputDecoration(contentPadding: EdgeInsets.symmetric(horizontal: 10)),
                    items: const [
                      DropdownMenuItem(value: 'stars', child: Text('Ситораҳо (Stars)')),
                      DropdownMenuItem(value: 'fiat', child: Text('Сомонӣ (Fiat)')),
                    ],
                    onChanged: (val) {
                      if (val != null) {
                        setState(() {
                          _currencyType = val;
                        });
                      }
                    },
                  ),
                ),
                const SizedBox(width: AppSizes.m),
                Expanded(
                  flex: 3,
                  child: OutlinedButton(
                    onPressed: _isSaving ? null : () => setState(() => _showAdjustmentForm = false),
                    child: Text(txtCancel),
                  ),
                ),
                const SizedBox(width: AppSizes.s),
                Expanded(
                  flex: 3,
                  child: Container(
                    height: 44,
                    decoration: BoxDecoration(
                      gradient: AppColors.primaryGradient,
                      borderRadius: AppSizes.borderRadiusM,
                    ),
                    child: ElevatedButton(
                      onPressed: _isSaving ? null : () => _submitAdjustment(parentId),
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.transparent,
                        shadowColor: Colors.transparent,
                        elevation: 0,
                      ),
                      child: _isSaving
                          ? const SizedBox(width: 18, height: 18, child: CircularProgressIndicator(color: Colors.white, strokeWidth: 2))
                          : Text(txtSave, style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
                    ),
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildLedgerItem(TransactionModel tx) {
    final isPositive = tx.amount >= 0;
    final Color txColor = isPositive 
        ? AppColors.success 
        : (tx.transactionType == 'penalty_deduction' ? AppColors.error : AppColors.textPrimaryLight);
        
    IconData txIcon;
    switch (tx.transactionType) {
      case 'task_reward':
        txIcon = Icons.task_alt_rounded;
        break;
      case 'penalty_deduction':
        txIcon = Icons.trending_down_rounded;
        break;
      case 'wishlist_payout':
        txIcon = Icons.card_giftcard_rounded;
        break;
      case 'manual_adjustment':
        txIcon = Icons.handyman_rounded;
        break;
      default:
        txIcon = Icons.payment_rounded;
    }

    return Container(
      margin: const EdgeInsets.only(bottom: AppSizes.m),
      padding: const EdgeInsets.all(AppSizes.m),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: AppSizes.borderRadiusM,
        border: Border.all(color: AppColors.borderLight, width: 1.2),
      ),
      child: Row(
        children: [
          Container(
            width: 36,
            height: 36,
            decoration: BoxDecoration(color: txColor.withOpacity(0.06), shape: BoxShape.circle),
            child: Icon(txIcon, color: txColor, size: 18),
          ),
          AppSizes.spaceL,
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  tx.description ?? 'Танзими молиявӣ',
                  style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 13, color: AppColors.textPrimaryLight),
                ),
                const SizedBox(height: 2),
                Text(
                  '${tx.createdAt.day}/${tx.createdAt.month} ${tx.createdAt.hour.toString().padLeft(2, '0')}:${tx.createdAt.minute.toString().padLeft(2, '0')}',
                  style: const TextStyle(color: Colors.grey, fontSize: 10),
                ),
              ],
            ),
          ),
          Row(
            children: [
              Text(
                isPositive 
                    ? '+${tx.currencyType == 'stars' ? tx.amount.toInt() : tx.amount.toStringAsFixed(1)}'
                    : '${tx.currencyType == 'stars' ? tx.amount.toInt() : tx.amount.toStringAsFixed(1)}',
                style: TextStyle(fontWeight: FontWeight.w900, fontSize: 15, color: txColor),
              ),
              const SizedBox(width: 2),
              Icon(
                tx.currencyType == 'stars' ? Icons.star_rounded : Icons.account_balance_wallet_rounded,
                color: tx.currencyType == 'stars' ? AppColors.accent : AppColors.success,
                size: 14,
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildNoChildrenState(BuildContext context) {
    return Center(
      child: Padding(
        padding: const EdgeInsets.all(AppSizes.xl),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const Icon(Icons.people_outline_rounded, size: 64, color: AppColors.textSecondaryDark),
            AppSizes.spaceM,
            const Text(
              'Аввал кӯдаконро дар панели асосӣ илова кунед.',
              style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold, color: AppColors.textSecondaryLight),
              textAlign: TextAlign.center,
            ),
            AppSizes.spaceL,
            ElevatedButton(
              onPressed: () => context.go(RoutePaths.parentDashboard),
              child: const Text('Баргаштан ба Панел'),
            ),
          ],
        ),
      ),
    );
  }
}
