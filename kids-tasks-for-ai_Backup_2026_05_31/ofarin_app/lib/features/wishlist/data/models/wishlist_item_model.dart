// ══════════════════════════════════════════════════════════════════════════════
// Wishlist Item Model — Data layer representation of a wishlist item
// ══════════════════════════════════════════════════════════════════════════════

class WishlistItemModel {
  final String id;
  final String childId;
  final String title;
  final String description;
  final String? imageUrl;
  final double priceFiat;
  final double priceStars;
  final double priceGold;
  final String status;
  final DateTime? createdAt;

  const WishlistItemModel({
    required this.id,
    required this.childId,
    required this.title,
    this.description = '',
    this.imageUrl,
    this.priceFiat = 0,
    this.priceStars = 0,
    this.priceGold = 0,
    this.status = 'pending_pricing',
    this.createdAt,
  });

  factory WishlistItemModel.fromJson(Map<String, dynamic> json) {
    return WishlistItemModel(
      id: json['id'] as String,
      childId: json['child_id'] as String,
      title: json['title'] as String,
      description: json['description'] as String? ?? '',
      imageUrl: json['image_url'] as String?,
      priceFiat: (json['price_fiat'] as num?)?.toDouble() ?? 0,
      priceStars: (json['price_stars'] as num?)?.toDouble() ?? 0,
      priceGold: (json['price_gold'] as num?)?.toDouble() ?? 0,
      status: json['status'] as String? ?? 'pending_pricing',
      createdAt: json['created_at'] != null ? DateTime.parse(json['created_at'] as String) : null,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'child_id': childId,
      'title': title,
      'description': description,
      'image_url': imageUrl,
      'price_fiat': priceFiat,
      'price_stars': priceStars,
      'price_gold': priceGold,
      'status': status,
    };
  }
}
