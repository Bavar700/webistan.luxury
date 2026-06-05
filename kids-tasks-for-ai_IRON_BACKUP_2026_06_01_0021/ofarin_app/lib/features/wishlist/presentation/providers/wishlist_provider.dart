// ══════════════════════════════════════════════════════════════════════════════
// Wishlist Provider — State management for wishlist items
// ══════════════════════════════════════════════════════════════════════════════

import 'package:flutter_riverpod/flutter_riverpod.dart';
import '../../data/models/wishlist_item_model.dart';

class WishlistState {
  final List<WishlistItemModel> items;
  final bool isLoading;

  const WishlistState({
    this.items = const [],
    this.isLoading = false,
  });

  WishlistState copyWith({List<WishlistItemModel>? items, bool? isLoading}) {
    return WishlistState(
      items: items ?? this.items,
      isLoading: isLoading ?? this.isLoading,
    );
  }
}

class WishlistNotifier extends StateNotifier<WishlistState> {
  WishlistNotifier() : super(const WishlistState());

  Future<void> loadWishlist(String childId) async {
    state = state.copyWith(isLoading: true);
    try {
      // TODO: Load from Supabase
      state = state.copyWith(isLoading: false);
    } catch (e) {
      state = state.copyWith(isLoading: false);
    }
  }

  void addItem(WishlistItemModel item) {
    state = state.copyWith(items: [...state.items, item]);
  }
}

final wishlistProvider = StateNotifierProvider<WishlistNotifier, WishlistState>((ref) {
  return WishlistNotifier();
});
