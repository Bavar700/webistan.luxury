/// Модели мукофот барои Ofarin
/// Reward model — items children can purchase from the shop

class RewardModel {
  final String id;
  final String title;
  final String? description;
  final String? imageUrl;
  final int price;
  final String currency; // '⭐' or '🪙'
  final String category; // 'toy', 'experience', 'privilege'

  const RewardModel({
    required this.id,
    required this.title,
    this.description,
    this.imageUrl,
    required this.price,
    this.currency = '⭐',
    this.category = 'toy',
  });

  RewardModel copyWith({
    String? id,
    String? title,
    String? description,
    String? imageUrl,
    int? price,
    String? currency,
    String? category,
  }) {
    return RewardModel(
      id: id ?? this.id,
      title: title ?? this.title,
      description: description ?? this.description,
      imageUrl: imageUrl ?? this.imageUrl,
      price: price ?? this.price,
      currency: currency ?? this.currency,
      category: category ?? this.category,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'title': title,
      'description': description,
      'image_url': imageUrl,
      'price': price,
      'currency': currency,
      'category': category,
    };
  }

  factory RewardModel.fromJson(Map<String, dynamic> json) {
    return RewardModel(
      id: json['id'] as String,
      title: json['title'] as String,
      description: json['description'] as String?,
      imageUrl: json['image_url'] as String?,
      price: (json['price'] as int?) ?? 0,
      currency: (json['currency'] as String?) ?? '⭐',
      category: (json['category'] as String?) ?? 'toy',
    );
  }

  /// Нишонаи категория 🎯
  static String getCategoryIcon(String category) {
    switch (category) {
      case 'toy':
        return '🧸';
      case 'experience':
        return '🎢';
      case 'privilege':
        return '👑';
      default:
        return '🎁';
    }
  }

  /// Номи категория бо забони тоҷикӣ 🇹🇯
  static String getCategoryLabel(String category) {
    switch (category) {
      case 'toy':
        return 'Бозича';
      case 'experience':
        return 'Таҷриба';
      case 'privilege':
        return 'Имтиёз';
      default:
        return 'Дигар';
    }
  }

  /// Нишонаи категорияи ин мукофот
  String get categoryIcon => getCategoryIcon(category);

  /// Номи категорияи ин мукофот
  String get categoryLabel => getCategoryLabel(category);

  /// Формати нархи намоишӣ
  String get formattedPrice => '$price $currency';

  @override
  String toString() {
    return 'RewardModel(id: $id, title: $title, price: $price $currency, category: $category)';
  }

  @override
  bool operator ==(Object other) {
    if (identical(this, other)) return true;
    return other is RewardModel && other.id == id;
  }

  @override
  int get hashCode => id.hashCode;
}
