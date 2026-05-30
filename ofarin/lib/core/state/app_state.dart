import 'dart:convert';
import 'package:flutter/foundation.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../models/user_model.dart';
import '../models/wallet_model.dart';
import '../models/task_model.dart';
import '../models/reward_model.dart';
import '../models/family_model.dart';
import '../models/xp_level_system.dart';

final sharedPreferencesProvider = Provider<SharedPreferences>((ref) {
  throw UnimplementedError();
});

// --- User State ---
class UserNotifier extends Notifier<UserModel?> {
  late SharedPreferences _prefs;

  @override
  UserModel? build() {
    _prefs = ref.watch(sharedPreferencesProvider);
    final savedUser = _prefs.getString('user_data');
    if (savedUser != null) {
      try {
        return UserModel.fromJson(jsonDecode(savedUser));
      } catch (e) {
        debugPrint('Error decoding user: $e');
      }
    }
    // Return a default child user for testing
    return const UserModel(
      id: 'child_1',
      name: 'Абдуллоҳ',
      role: 'child',
      familyId: 'family_1',
      avatarEmoji: '🦁',
      level: 1,
      totalXp: 0,
    );
  }

  void _save() {
    if (state != null) {
      _prefs.setString('user_data', jsonEncode(state!.toJson()));
    } else {
      _prefs.remove('user_data');
    }
  }

  void login(UserModel user) {
    state = user;
    _save();
  }

  void logout() {
    state = null;
    _save();
  }

  void addXp(int amount) {
    if (state == null) return;
    
    final currentXp = state!.totalXp;
    final newXp = currentXp + amount;
    final newLevel = XpLevelSystem.getLevelForXp(newXp);
    
    state = state!.copyWith(
      totalXp: newXp,
      level: newLevel,
    );
    _save();
  }
}

final userProvider = NotifierProvider<UserNotifier, UserModel?>(() {
  return UserNotifier();
});

// --- Wallet State ---
class WalletNotifier extends Notifier<WalletModel> {
  late SharedPreferences _prefs;

  @override
  WalletModel build() {
    _prefs = ref.watch(sharedPreferencesProvider);
    final savedWallet = _prefs.getString('wallet_data');
    if (savedWallet != null) {
      try {
        return WalletModel.fromJson(jsonDecode(savedWallet));
      } catch (e) {
        debugPrint('Error decoding wallet: $e');
      }
    }
    return const WalletModel(
      childId: 'child_1',
      balanceStars: 10,
      balanceCoins: 5,
      balanceFiat: 0.0,
    );
  }

  void _save() {
    _prefs.setString('wallet_data', jsonEncode(state.toJson()));
  }

  void addCurrency({int stars = 0, int coins = 0, double fiat = 0.0}) {
    state = state.copyWith(
      balanceStars: state.balanceStars + stars,
      balanceCoins: state.balanceCoins + coins,
      balanceFiat: state.balanceFiat + fiat,
    );
    _save();
  }

  bool spendCurrency(int amount, String currencyType) {
    if (state.canAfford(amount, currencyType)) {
      if (currencyType == '⭐️' || currencyType == 'stars') {
        state = state.copyWith(balanceStars: state.balanceStars - amount);
      } else if (currencyType == '🪙' || currencyType == 'coins') {
        state = state.copyWith(balanceCoins: state.balanceCoins - amount);
      } else if (currencyType == '💵' || currencyType == 'fiat') {
        state = state.copyWith(balanceFiat: state.balanceFiat - amount);
      }
      _save();
      return true;
    }
    return false;
  }
}

final walletProvider = NotifierProvider<WalletNotifier, WalletModel>(() {
  return WalletNotifier();
});

// --- Tasks State ---
class TasksNotifier extends Notifier<List<TaskModel>> {
  late SharedPreferences _prefs;

  @override
  List<TaskModel> build() {
    _prefs = ref.watch(sharedPreferencesProvider);
    final savedTasks = _prefs.getString('tasks_data_v2');
    if (savedTasks != null) {
      try {
        final List<dynamic> decoded = jsonDecode(savedTasks);
        return decoded.map((e) => TaskModel.fromJson(e)).toList();
      } catch (e) {
        debugPrint('Error decoding tasks: $e');
        _prefs.remove('tasks_data_v2');
      }
    }
    
    // Default tasks
    return [
      TaskModel(
        id: '1',
        childId: 'child_1',
        parentId: 'parent_1',
        title: 'Хонаро тоза кардан',
        description: 'Ҳамаи бозичаҳоро ба ҷояшон гузор ва фаршро рӯб.',
        rewardXp: 50,
        rewardCoins: 10,
        difficulty: 'medium',
        createdAt: DateTime.now(),
        updatedAt: DateTime.now(),
      ),
      TaskModel(
        id: '2',
        childId: 'child_1',
        parentId: 'parent_1',
        title: 'Дарси математика',
        description: 'Вазифаи хонагии математикаро иҷро кун.',
        rewardXp: 30,
        rewardCoins: 5,
        difficulty: 'easy',
        createdAt: DateTime.now(),
        updatedAt: DateTime.now(),
      ),
      TaskModel(
        id: '3',
        childId: 'child_1',
        parentId: 'parent_1',
        title: 'Китоб хондан',
        description: '30 дақиқа китоб хон.',
        rewardXp: 100,
        rewardCoins: 15,
        difficulty: 'hard',
        createdAt: DateTime.now(),
        updatedAt: DateTime.now(),
      ),
    ];
  }

  void _save() {
    _prefs.setString('tasks_data_v2', jsonEncode(state.map((t) => t.toJson()).toList()));
  }

  void addTask(TaskModel task) {
    state = [...state, task];
    _save();
  }

  void submitTask(String id) {
    state = state.map((task) {
      if (task.id == id) {
        return task.copyWith(
          status: 'pending_approval', 
          updatedAt: DateTime.now()
        );
      }
      return task;
    }).toList();
    _save();
  }

  void approveTask(String id, WalletNotifier wallet, UserNotifier user) {
    final taskIndex = state.indexWhere((t) => t.id == id);
    if (taskIndex != -1) {
      final task = state[taskIndex];
      if (task.status == 'pending_approval') {
        wallet.addCurrency(
          stars: task.rewardXp, // Assuming stars = XP for some legacy UI, but really XP goes to user
          coins: task.rewardCoins,
          fiat: task.rewardFiat,
        );
        user.addXp(task.rewardXp);
        
        state = [
          ...state.sublist(0, taskIndex),
          task.copyWith(status: 'completed', updatedAt: DateTime.now()),
          ...state.sublist(taskIndex + 1)
        ];
        _save();
      }
    }
  }

  void rejectTask(String id, String reason) {
    final taskIndex = state.indexWhere((t) => t.id == id);
    if (taskIndex != -1) {
      state = [
        ...state.sublist(0, taskIndex),
        state[taskIndex].copyWith(
          status: 'rejected',
          rejectReason: reason,
          updatedAt: DateTime.now()
        ),
        ...state.sublist(taskIndex + 1)
      ];
      _save();
    }
  }
}

final tasksProvider = NotifierProvider<TasksNotifier, List<TaskModel>>(() {
  return TasksNotifier();
});

// --- Rewards State ---
class RewardsNotifier extends Notifier<List<RewardModel>> {
  late SharedPreferences _prefs;

  @override
  List<RewardModel> build() {
    _prefs = ref.watch(sharedPreferencesProvider);
    final savedRewards = _prefs.getString('rewards_data_v2');
    if (savedRewards != null) {
      try {
        final List<dynamic> decoded = jsonDecode(savedRewards);
        return decoded.map((e) => RewardModel.fromJson(e)).toList();
      } catch (e) {
        debugPrint('Error decoding rewards: $e');
        _prefs.remove('rewards_data_v2');
      }
    }
    
    return [
      const RewardModel(id: '1', title: 'Бозикунӣ (1 соат)', price: 30, currency: '🪙', category: 'privilege'),
      const RewardModel(id: '2', title: 'Яхмос', price: 15, currency: '🪙', category: 'experience'),
      const RewardModel(id: '3', title: 'Бозичаи нав', price: 150, currency: '💵', category: 'toy'),
      const RewardModel(id: '4', title: 'Парки дилхушӣ', price: 50, currency: '🪙', category: 'experience'),
    ];
  }

  void _save() {
    _prefs.setString('rewards_data_v2', jsonEncode(state.map((r) => r.toJson()).toList()));
  }

  void addReward(RewardModel reward) {
    state = [...state, reward];
    _save();
  }
}

final rewardsProvider = NotifierProvider<RewardsNotifier, List<RewardModel>>(() {
  return RewardsNotifier();
});
