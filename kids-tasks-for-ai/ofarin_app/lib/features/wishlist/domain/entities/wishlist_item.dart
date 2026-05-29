// ══════════════════════════════════════════════════════════════════════════════
// Wishlist Item Domain Entity
// ══════════════════════════════════════════════════════════════════════════════

class WishlistItem {
  final String id;
  final String title;
  final String description;
  final String? imageUrl;
  final double priceFiat;
  final double priceStars;
  final double priceGold;
  final String status;

  const WishlistItem({
    required this.id,
    required this.title,
    this.description = '',
    this.imageUrl,
    this.priceFiat = 0,
    this.priceStars = 0,
    this.priceGold = 0,
    this.status = 'pending_pricing',
  });

  bool get isPendingPricing => status == 'pending_pricing';
  bool get isActiveGoal => status == 'active_goal';
  bool get isFulfilled => status == 'fulfilled';
}
