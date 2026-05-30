import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:supabase_flutter/supabase_flutter.dart';
import '../../auth/data/auth_repository.dart';

// Provider for EconomyRepository
final economyRepositoryProvider = Provider<EconomyRepository>((ref) {
  final authRepo = ref.watch(authRepositoryProvider);
  return EconomyRepository(authRepo);
});

class WishlistItemModel {
  final String id;
  final String childId;
  final String title;
  final String? description;
  final double costAmount;
  final String currencyType; // 'stars' or 'fiat'
  final String status; // 'pending', 'approved', 'paid', 'rejected'
  final String? imageUrl;
  final DateTime createdAt;

  WishlistItemModel({
    required this.id,
    required this.childId,
    required this.title,
    this.description,
    required this.costAmount,
    required this.currencyType,
    this.status = 'pending',
    this.imageUrl,
    required this.createdAt,
  });

  WishlistItemModel copyWith({
    String? id,
    String? childId,
    String? title,
    String? description,
    double? costAmount,
    String? currencyType,
    String? status,
    String? imageUrl,
    DateTime? createdAt,
  }) {
    return WishlistItemModel(
      id: id ?? this.id,
      childId: childId ?? this.childId,
      title: title ?? this.title,
      description: description ?? this.description,
      costAmount: costAmount ?? this.costAmount,
      currencyType: currencyType ?? this.currencyType,
      status: status ?? this.status,
      imageUrl: imageUrl ?? this.imageUrl,
      createdAt: createdAt ?? this.createdAt,
    );
  }

  factory WishlistItemModel.fromJson(Map<String, dynamic> json) {
    return WishlistItemModel(
      id: json['id'] as String,
      childId: json['child_id'] as String,
      title: json['title'] as String,
      description: json['description'] as String?,
      costAmount: (json['cost_amount'] as num).toDouble(),
      currencyType: json['currency_type'] as String,
      status: json['status'] as String,
      imageUrl: json['image_url'] as String?,
      createdAt: DateTime.parse(json['created_at'] as String),
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'child_id': childId,
      'title': title,
      'description': description,
      'cost_amount': costAmount,
      'currency_type': currencyType,
      'status': status,
      'image_url': imageUrl,
    };
  }
}

class TransactionModel {
  final String id;
  final String childId;
  final String? parentId;
  final String? taskId;
  final double amount; // Positive or negative
  final String currencyType; // 'stars', 'fiat'
  final String transactionType; // 'task_reward', 'penalty_deduction', 'wishlist_payout', 'manual_adjustment'
  final String? description;
  final DateTime createdAt;

  TransactionModel({
    required this.id,
    required this.childId,
    this.parentId,
    this.taskId,
    required this.amount,
    required this.currencyType,
    required this.transactionType,
    this.description,
    required this.createdAt,
  });

  factory TransactionModel.fromJson(Map<String, dynamic> json) {
    return TransactionModel(
      id: json['id'] as String,
      childId: json['child_id'] as String,
      parentId: json['parent_id'] as String?,
      taskId: json['task_id'] as String?,
      amount: (json['amount'] as num).toDouble(),
      currencyType: json['currency_type'] as String,
      transactionType: json['transaction_type'] as String,
      description: json['description'] as String?,
      createdAt: DateTime.parse(json['created_at'] as String),
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'child_id': childId,
      'parent_id': parentId,
      'task_id': taskId,
      'amount': amount,
      'currency_type': currencyType,
      'transaction_type': transactionType,
      'description': description,
    };
  }
}

class EconomyRepository {
  final AuthRepository _authRepo;

  EconomyRepository(this._authRepo);

  bool get _isMock => _authRepo.isMock;

  // Mock Wishlist goals persistence list
  static final List<WishlistItemModel> _mockWishlist = [
    WishlistItemModel(
      id: 'mock-wish-1',
      childId: 'mock-child-1',
      title: 'Конструктори Lego Set 🦊',
      description: 'Lego Creator 3-in-1 дӯстдоштаи ман',
      costAmount: 60.0,
      currencyType: 'fiat',
      status: 'pending',
      createdAt: DateTime.now().subtract(const Duration(days: 3)),
    ),
    WishlistItemModel(
      id: 'mock-wish-2',
      childId: 'mock-child-1',
      title: 'Тӯби футболи чармӣ ⚽',
      description: 'Барои бозӣ кардан бо дӯстон дар майдонча',
      costAmount: 30.0,
      currencyType: 'stars',
      status: 'approved', // Saved enough, parent approved but not paid/completed yet
      createdAt: DateTime.now().subtract(const Duration(days: 10)),
    ),
  ];

  // Mock Ledger Transactions history list
  static final List<TransactionModel> _mockTransactions = [
    TransactionModel(
      id: 'tx-1',
      childId: 'mock-child-1',
      amount: 5.0,
      currencyType: 'stars',
      transactionType: 'task_reward',
      description: 'Шеъри навро ёд гирифтан 📖',
      createdAt: DateTime.now().subtract(const Duration(days: 1)),
    ),
    TransactionModel(
      id: 'tx-2',
      childId: 'mock-child-1',
      amount: -1.0,
      currencyType: 'stars',
      transactionType: 'penalty_deduction',
      description: 'Ҷарима: вазифаи фаромӯшшуда',
      createdAt: DateTime.now().subtract(const Duration(hours: 15)),
    ),
    TransactionModel(
      id: 'tx-3',
      childId: 'mock-child-1',
      amount: 10.0,
      currencyType: 'stars',
      transactionType: 'task_reward',
      description: 'Тартиб додани ҳуҷраи хоб 🧹',
      createdAt: DateTime.now().subtract(const Duration(hours: 5)),
    ),
    TransactionModel(
      id: 'tx-4',
      childId: 'mock-child-2',
      amount: 3.0,
      currencyType: 'fiat',
      transactionType: 'task_reward',
      description: 'Кӯмак ба модар дар ошхона 🍳',
      createdAt: DateTime.now().subtract(const Duration(days: 2)),
    ),
  ];

  SupabaseClient? get _client {
    try {
      if (Supabase.instance.client.auth.currentSession != null || 
          Supabase.instance.client.auth.currentUser != null) {
        return Supabase.instance.client;
      }
    } catch (_) {}
    return null;
  }

  // 1. Fetch Wishlist goals for child
  Future<List<WishlistItemModel>> fetchWishlistForChild(String childId) async {
    final client = _client;
    if (_isMock || client == null) {
      await Future.delayed(const Duration(milliseconds: 300));
      return _mockWishlist.where((w) => w.childId == childId).toList();
    }

    final data = await client
        .from('wishlist_items')
        .select()
        .eq('child_id', childId)
        .order('created_at', ascending: false);

    return (data as List).map((json) => WishlistItemModel.fromJson(json)).toList();
  }

  // 2. Add Wishlist item goal
  Future<WishlistItemModel> createWishlistItem(WishlistItemModel item) async {
    final client = _client;
    if (_isMock || client == null) {
      final newItem = item.copyWith(
        id: 'wish-${DateTime.now().millisecondsSinceEpoch}',
        createdAt: DateTime.now(),
      );
      _mockWishlist.insert(0, newItem);
      return newItem;
    }

    final itemData = item.toJson();
    itemData.remove('id');
    itemData['created_at'] = DateTime.now().toIso8601String();
    itemData['updated_at'] = DateTime.now().toIso8601String();

    final response = await client
        .from('wishlist_items')
        .insert(itemData)
        .select()
        .single();

    return WishlistItemModel.fromJson(response);
  }

  // 3. Child Requests Purchase / Payout
  Future<WishlistItemModel> requestWishlistPayout(String itemId) async {
    final client = _client;
    if (_isMock || client == null) {
      final index = _mockWishlist.indexWhere((w) => w.id == itemId);
      if (index != -1) {
        final updated = _mockWishlist[index].copyWith(status: 'approved'); // Marked approved (pending parent payout)
        _mockWishlist[index] = updated;
        return updated;
      }
      throw Exception('Орзу ёфт нашуд');
    }

    final response = await client
        .from('wishlist_items')
        .update({
          'status': 'approved',
          'updated_at': DateTime.now().toIso8601String(),
        })
        .eq('id', itemId)
        .select()
        .single();

    return WishlistItemModel.fromJson(response);
  }

  // 4. Parent Approves Purchase (Deducts balance, sets status to 'paid')
  Future<void> approveWishlistPurchase(String itemId, String childId, double cost, String currencyType, String itemTitle) async {
    final client = _client;

    // A. Update Wishlist Item state
    if (_isMock || client == null) {
      final index = _mockWishlist.indexWhere((w) => w.id == itemId);
      if (index != -1) {
        _mockWishlist[index] = _mockWishlist[index].copyWith(status: 'paid');
      }
    } else {
      await client
          .from('wishlist_items')
          .update({
            'status': 'paid',
            'updated_at': DateTime.now().toIso8601String(),
          })
          .eq('id', itemId);
    }

    // B. Deduct balance from Child Profile
    await _authRepo.updateChildBalance(childId, -cost, currencyType);

    // C. Write transaction ledger audit
    if (_isMock) {
      _mockTransactions.insert(
        0,
        TransactionModel(
          id: 'tx-${DateTime.now().millisecondsSinceEpoch}',
          childId: childId,
          amount: -cost,
          currencyType: currencyType,
          transactionType: 'wishlist_payout',
          description: 'Харидории орзу: "$itemTitle"',
          createdAt: DateTime.now(),
        ),
      );
    } else if (client != null) {
      await client.from('transactions').insert({
        'child_id': childId,
        'amount': -cost,
        'currency_type': currencyType,
        'transaction_type': 'wishlist_payout',
        'description': 'Харидории орзу: "$itemTitle"',
      });
    }
  }

  // 5. Parent Rejects / Resets Wishlist item
  Future<void> rejectWishlistItem(String itemId) async {
    final client = _client;
    if (_isMock || client == null) {
      final index = _mockWishlist.indexWhere((w) => w.id == itemId);
      if (index != -1) {
        _mockWishlist[index] = _mockWishlist[index].copyWith(status: 'rejected');
      }
      return;
    }

    await client
        .from('wishlist_items')
        .update({
          'status': 'rejected',
          'updated_at': DateTime.now().toIso8601String(),
        })
        .eq('id', itemId);
  }

  // 6. Fetch Transaction Ledger History for child
  Future<List<TransactionModel>> fetchTransactions(String childId) async {
    final client = _client;
    if (_isMock || client == null) {
      await Future.delayed(const Duration(milliseconds: 300));
      return _mockTransactions.where((t) => t.childId == childId).toList();
    }

    final data = await client
        .from('transactions')
        .select()
        .eq('child_id', childId)
        .order('created_at', ascending: false);

    return (data as List).map((json) => TransactionModel.fromJson(json)).toList();
  }

  // 7. Manual Balance Adjustment (Add rewards, deduct corrections)
  Future<void> logManualAdjustment(String childId, String? parentId, double amount, String currencyType, String description) async {
    final client = _client;

    // A. Adjust profile balance
    await _authRepo.updateChildBalance(childId, amount, currencyType);

    // B. Write transaction log
    if (_isMock) {
      _mockTransactions.insert(
        0,
        TransactionModel(
          id: 'tx-${DateTime.now().millisecondsSinceEpoch}',
          childId: childId,
          parentId: parentId,
          amount: amount,
          currencyType: currencyType,
          transactionType: 'manual_adjustment',
          description: description,
          createdAt: DateTime.now(),
        ),
      );
    } else if (client != null) {
      await client.from('transactions').insert({
        'child_id': childId,
        'parent_id': parentId,
        'amount': amount,
        'currency_type': currencyType,
        'transaction_type': 'manual_adjustment',
        'description': description,
      });
    }
  }
}
