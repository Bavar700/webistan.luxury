// ══════════════════════════════════════════════════════════════════════════════
// Balance Provider — State management for wallet balances
// ══════════════════════════════════════════════════════════════════════════════

import 'package:flutter_riverpod/flutter_riverpod.dart';

class BalanceState {
  final double fiat;
  final double stars;
  final double gold;
  final bool isLoading;

  const BalanceState({
    this.fiat = 0,
    this.stars = 0,
    this.gold = 0,
    this.isLoading = false,
  });

  BalanceState copyWith({double? fiat, double? stars, double? gold, bool? isLoading}) {
    return BalanceState(
      fiat: fiat ?? this.fiat,
      stars: stars ?? this.stars,
      gold: gold ?? this.gold,
      isLoading: isLoading ?? this.isLoading,
    );
  }
}

class BalanceNotifier extends StateNotifier<BalanceState> {
  BalanceNotifier() : super(const BalanceState());

  Future<void> loadBalance(String childId) async {
    state = state.copyWith(isLoading: true);
    try {
      // TODO: Load from Supabase using get_wallet() function
      state = state.copyWith(isLoading: false);
    } catch (e) {
      state = state.copyWith(isLoading: false);
    }
  }

  void addFiat(double amount) {
    state = state.copyWith(fiat: state.fiat + amount);
  }

  void addStars(double amount) {
    state = state.copyWith(stars: state.stars + amount);
  }

  void addGold(double amount) {
    state = state.copyWith(gold: state.gold + amount);
  }

  bool deductFiat(double amount) {
    if (state.fiat >= amount) {
      state = state.copyWith(fiat: state.fiat - amount);
      return true;
    }
    return false;
  }

  bool deductStars(double amount) {
    if (state.stars >= amount) {
      state = state.copyWith(stars: state.stars - amount);
      return true;
    }
    return false;
  }

  bool deductGold(double amount) {
    if (state.gold >= amount) {
      state = state.copyWith(gold: state.gold - amount);
      return true;
    }
    return false;
  }
}

final balanceProvider = StateNotifierProvider<BalanceNotifier, BalanceState>((ref) {
  return BalanceNotifier();
});
