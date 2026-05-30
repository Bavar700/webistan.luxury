import 'dart:convert';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:supabase_flutter/supabase_flutter.dart';
import '../../auth/data/auth_repository.dart';

// Provider for TaskRepository
final taskRepositoryProvider = Provider<TaskRepository>((ref) {
  final authRepo = ref.watch(authRepositoryProvider);
  return TaskRepository(authRepo);
});

class TaskModel {
  final String id;
  final String parentId;
  final String childId;
  final String title;
  final String? description;
  final String taskType; // 'routine', 'deadline', 'bonus', 'timer_lock'
  final String rewardType; // 'stars', 'fiat'
  final double rewardAmount;
  final double penaltyAmount;
  final String status; // 'todo', 'in_progress', 'done_pending_approval', 'completed', 'failed'
  final DateTime? deadline;
  final int? timerDurationSeconds;
  final int timeSpentSeconds;
  final DateTime? timerStartedAt;
  final DateTime? completedAt;
  final DateTime? approvedAt;
  final DateTime createdAt;
  final String? submissionComment;
  final String? submissionImageUrl;

  TaskModel({
    required this.id,
    required this.parentId,
    required this.childId,
    required this.title,
    this.description,
    required this.taskType,
    required this.rewardType,
    required this.rewardAmount,
    this.penaltyAmount = 0.0,
    this.status = 'todo',
    this.deadline,
    this.timerDurationSeconds,
    this.timeSpentSeconds = 0,
    this.timerStartedAt,
    this.completedAt,
    this.approvedAt,
    required this.createdAt,
    this.submissionComment,
    this.submissionImageUrl,
  });

  TaskModel copyWith({
    String? id,
    String? parentId,
    String? childId,
    String? title,
    String? description,
    String? taskType,
    String? rewardType,
    double? rewardAmount,
    double? penaltyAmount,
    String? status,
    DateTime? deadline,
    int? timerDurationSeconds,
    int? timeSpentSeconds,
    DateTime? timerStartedAt,
    DateTime? completedAt,
    DateTime? approvedAt,
    DateTime? createdAt,
    String? submissionComment,
    String? submissionImageUrl,
  }) {
    return TaskModel(
      id: id ?? this.id,
      parentId: parentId ?? this.parentId,
      childId: childId ?? this.childId,
      title: title ?? this.title,
      description: description ?? this.description,
      taskType: taskType ?? this.taskType,
      rewardType: rewardType ?? this.rewardType,
      rewardAmount: rewardAmount ?? this.rewardAmount,
      penaltyAmount: penaltyAmount ?? this.penaltyAmount,
      status: status ?? this.status,
      deadline: deadline ?? this.deadline,
      timerDurationSeconds: timerDurationSeconds ?? this.timerDurationSeconds,
      timeSpentSeconds: timeSpentSeconds ?? this.timeSpentSeconds,
      timerStartedAt: timerStartedAt ?? this.timerStartedAt,
      completedAt: completedAt ?? this.completedAt,
      approvedAt: approvedAt ?? this.approvedAt,
      createdAt: createdAt ?? this.createdAt,
      submissionComment: submissionComment ?? this.submissionComment,
      submissionImageUrl: submissionImageUrl ?? this.submissionImageUrl,
    );
  }

  factory TaskModel.fromJson(Map<String, dynamic> json) {
    return TaskModel(
      id: json['id'] as String,
      parentId: json['parent_id'] as String,
      childId: json['child_id'] as String,
      title: json['title'] as String,
      description: json['description'] as String?,
      taskType: json['task_type'] as String,
      rewardType: json['reward_type'] as String,
      rewardAmount: (json['reward_amount'] as num).toDouble(),
      penaltyAmount: (json['penalty_amount'] as num? ?? 0.0).toDouble(),
      status: json['status'] as String,
      deadline: json['deadline'] != null ? DateTime.parse(json['deadline'] as String) : null,
      timerDurationSeconds: json['timer_duration_seconds'] as int?,
      timeSpentSeconds: json['time_spent_seconds'] as int? ?? 0,
      timerStartedAt: json['timer_started_at'] != null ? DateTime.parse(json['timer_started_at'] as String) : null,
      completedAt: json['completed_at'] != null ? DateTime.parse(json['completed_at'] as String) : null,
      approvedAt: json['approved_at'] != null ? DateTime.parse(json['approved_at'] as String) : null,
      createdAt: DateTime.parse(json['created_at'] as String),
      submissionComment: json['submission_comment'] as String?,
      submissionImageUrl: json['submission_image_url'] as String?,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'parent_id': parentId,
      'child_id': childId,
      'title': title,
      'description': description,
      'task_type': taskType,
      'reward_type': rewardType,
      'reward_amount': rewardAmount,
      'penalty_amount': penaltyAmount,
      'status': status,
      'deadline': deadline?.toIso8601String(),
      'timer_duration_seconds': timerDurationSeconds,
      'time_spent_seconds': timeSpentSeconds,
      'timer_started_at': timerStartedAt?.toIso8601String(),
      'completed_at': completedAt?.toIso8601String(),
      'approved_at': approvedAt?.toIso8601String(),
      'submission_comment': submissionComment,
      'submission_image_url': submissionImageUrl,
    };
  }
}

class TaskRepository {
  final AuthRepository _authRepo;

  TaskRepository(this._authRepo);

  bool get _isMock => _authRepo.isMock;

  // Static fallback mock tasks
  static final List<TaskModel> _defaultMockTasks = [
    TaskModel(
      id: 'mock-task-1',
      parentId: 'mock-parent-id',
      childId: 'mock-child-1',
      title: 'Шеъри навро ёд гирифтан 📖',
      description: 'Шеъри устод Рӯдакиро дар бораи дӯстӣ ҳифз намо ва қироат кун.',
      taskType: 'routine',
      rewardType: 'stars',
      rewardAmount: 5.0,
      status: 'todo',
      createdAt: DateTime.now().subtract(const Duration(days: 1)),
    ),
    TaskModel(
      id: 'mock-task-2',
      parentId: 'mock-parent-id',
      childId: 'mock-child-1',
      title: 'Математика 20 дақиқа 🧮',
      description: 'Таймерро фаъол карда, супоришҳои риёзиро мустақилона иҷро кун.',
      taskType: 'timer_lock',
      rewardType: 'fiat',
      rewardAmount: 2.0,
      timerDurationSeconds: 1200,
      status: 'todo',
      createdAt: DateTime.now().subtract(const Duration(hours: 12)),
    ),
    TaskModel(
      id: 'mock-task-3',
      parentId: 'mock-parent-id',
      childId: 'mock-child-1',
      title: 'Тартиб додани ҳуҷраи хоб 🧹',
      description: 'Бозичаҳоро ҷамъ кун, катро ҳамвор кун ва хошокро тоза кун.',
      taskType: 'deadline',
      rewardType: 'stars',
      rewardAmount: 8.0,
      deadline: DateTime.now().add(const Duration(hours: 4)),
      status: 'done_pending_approval',
      createdAt: DateTime.now().subtract(const Duration(hours: 5)),
      completedAt: DateTime.now().subtract(const Duration(minutes: 30)),
    ),
    TaskModel(
      id: 'mock-task-4',
      parentId: 'mock-parent-id',
      childId: 'mock-child-2',
      title: 'Кӯмак ба модар дар ошхона 🍳',
      description: 'Пас аз хӯрокхӯрӣ табақҳоро ба мошин ё дастшӯӣ гузор.',
      taskType: 'bonus',
      rewardType: 'fiat',
      rewardAmount: 3.0,
      status: 'todo',
      createdAt: DateTime.now().subtract(const Duration(days: 2)),
    ),
  ];

  List<TaskModel>? _customMockTasks;

  Future<List<TaskModel>> _getMockTasks() async {
    if (_customMockTasks != null) return _customMockTasks!;
    try {
      final prefs = await SharedPreferences.getInstance();
      final jsonStr = prefs.getString('mock_tasks_data');
      if (jsonStr != null) {
        final List decoded = json.decode(jsonStr);
        _customMockTasks = decoded.map((item) => TaskModel.fromJson(item)).toList();
        return _customMockTasks!;
      }
    } catch (_) {}
    _customMockTasks = List.from(_defaultMockTasks);
    return _customMockTasks!;
  }

  Future<void> _saveMockTasks(List<TaskModel> tasks) async {
    _customMockTasks = tasks;
    try {
      final prefs = await SharedPreferences.getInstance();
      final jsonStr = json.encode(tasks.map((t) => t.toJson()).toList());
      await prefs.setString('mock_tasks_data', jsonStr);
    } catch (_) {}
  }

  // Helper to access Supabase client safely
  SupabaseClient? get _client {
    try {
      if (Supabase.instance.client.auth.currentSession != null || 
          Supabase.instance.client.auth.currentUser != null) {
        return Supabase.instance.client;
      }
    } catch (_) {}
    return null;
  }

  // 1. Fetch Tasks for Child
  Future<List<TaskModel>> fetchTasksForChild(String childId) async {
    final client = _client;
    if (_isMock || client == null) {
      await Future.delayed(const Duration(milliseconds: 300));
      final tasks = await _getMockTasks();
      final childTasks = tasks.where((t) => t.childId == childId).toList();
      if (childTasks.isEmpty) {
        final seeded = [
          TaskModel(
            id: 'seeded-task-1-$childId',
            parentId: 'mock-parent-id',
            childId: childId,
            title: 'Шеъри навро ёд гирифтан 📖',
            description: 'Шеъри устод Рӯдакиро дар бораи дӯстӣ ҳифз намо ва қироат кун.',
            taskType: 'routine',
            rewardType: 'stars',
            rewardAmount: 5.0,
            status: 'todo',
            createdAt: DateTime.now().subtract(const Duration(days: 1)),
          ),
          TaskModel(
            id: 'seeded-task-2-$childId',
            parentId: 'mock-parent-id',
            childId: childId,
            title: 'Математика 20 дақиқа 🧮',
            description: 'Таймерро фаъол карда, супоришҳои риёзиро мустақилона иҷро кун.',
            taskType: 'timer_lock',
            rewardType: 'fiat',
            rewardAmount: 2.0,
            timerDurationSeconds: 1200,
            status: 'todo',
            createdAt: DateTime.now().subtract(const Duration(hours: 12)),
          ),
        ];
        tasks.addAll(seeded);
        await _saveMockTasks(tasks);
        return seeded;
      }
      return childTasks;
    }

    final data = await client
        .from('tasks')
        .select()
        .eq('child_id', childId)
        .order('created_at', ascending: false);

    return (data as List).map((json) => TaskModel.fromJson(json)).toList();
  }

  // 2. Create a new Task
  Future<TaskModel> createTask(TaskModel task) async {
    final client = _client;
    if (_isMock || client == null) {
      final newTask = task.copyWith(
        id: 'task-${DateTime.now().millisecondsSinceEpoch}',
        createdAt: DateTime.now(),
      );
      final tasks = await _getMockTasks();
      tasks.insert(0, newTask);
      await _saveMockTasks(tasks);
      return newTask;
    }

    // Prepare JSON data (strip out generated fields if database handles them)
    final taskData = task.toJson();
    taskData.remove('id'); // DB sets gen_random_uuid()
    taskData['created_at'] = DateTime.now().toIso8601String();
    taskData['updated_at'] = DateTime.now().toIso8601String();

    final response = await client
        .from('tasks')
        .insert(taskData)
        .select()
        .single();

    return TaskModel.fromJson(response);
  }

  // 3. Update Task Status (General status changes)
  Future<TaskModel> updateTaskStatus(
    String taskId,
    String status, {
    String? submissionComment,
    String? submissionImageUrl,
  }) async {
    final client = _client;
    
    if (_isMock || client == null) {
      final tasks = await _getMockTasks();
      final index = tasks.indexWhere((t) => t.id == taskId);
      if (index != -1) {
        var updated = tasks[index].copyWith(
          status: status,
          submissionComment: submissionComment,
          submissionImageUrl: submissionImageUrl,
        );
        if (status == 'done_pending_approval') {
          updated = updated.copyWith(completedAt: DateTime.now());
        }
        tasks[index] = updated;
        await _saveMockTasks(tasks);
        return updated;
      }
      throw Exception('Вазифа ёфт нашуд (Task not found)');
    }

    final Map<String, dynamic> updateData = {
      'status': status,
      'updated_at': DateTime.now().toIso8601String(),
    };
    if (status == 'done_pending_approval') {
      updateData['completed_at'] = DateTime.now().toIso8601String();
    }
    if (submissionComment != null) {
      updateData['submission_comment'] = submissionComment;
    }
    if (submissionImageUrl != null) {
      updateData['submission_image_url'] = submissionImageUrl;
    }

    final response = await client
        .from('tasks')
        .update(updateData)
        .eq('id', taskId)
        .select()
        .single();

    return TaskModel.fromJson(response);
  }

  // 4. Approve Task (Marks completed, credits child profile, logs transaction audit ledger)
  Future<void> approveTask(String taskId, String childId, double rewardAmount, String rewardType) async {
    final client = _client;

    // A. Update Task Table
    if (_isMock || client == null) {
      final tasks = await _getMockTasks();
      final index = tasks.indexWhere((t) => t.id == taskId);
      if (index != -1) {
        tasks[index] = tasks[index].copyWith(
          status: 'completed',
          approvedAt: DateTime.now(),
        );
        await _saveMockTasks(tasks);
      }
    } else {
      await client
          .from('tasks')
          .update({
            'status': 'completed',
            'approvedAt': DateTime.now().toIso8601String(),
            'updated_at': DateTime.now().toIso8601String(),
          })
          .eq('id', taskId);
    }

    // B. Credit Child Profile Balance
    await _authRepo.updateChildBalance(childId, rewardAmount, rewardType);

    // C. Write transaction audit ledger
    if (!_isMock && client != null) {
      await client.from('transactions').insert({
        'child_id': childId,
        'amount': rewardAmount,
        'currency_type': rewardType,
        'transaction_type': 'task_reward',
        'task_id': taskId,
        'description': 'Тасдиқи вазифа (Task Approved)',
      });
    }
  }

  // 5. Reject Task (Resets task back to Todo state)
  Future<void> rejectTask(String taskId) async {
    final client = _client;
    if (_isMock || client == null) {
      final tasks = await _getMockTasks();
      final index = tasks.indexWhere((t) => t.id == taskId);
      if (index != -1) {
        tasks[index] = tasks[index].copyWith(
          status: 'todo',
          completedAt: null,
        );
        await _saveMockTasks(tasks);
      }
      return;
    }

    await client
        .from('tasks')
        .update({
          'status': 'todo',
          'completed_at': null,
          'updated_at': DateTime.now().toIso8601String(),
        })
        .eq('id', taskId);
  }

  // 6. Deduct Penalty (Parent manual deduction or missed task automation)
  Future<void> applyPenalty(String childId, double penaltyAmount, String rewardType, String taskTitle) async {
    final client = _client;

    // A. Deduct from child profile balance (updates balance with a negative amount)
    await _authRepo.updateChildBalance(childId, -penaltyAmount, rewardType);

    // B. Log transaction ledger entry
    if (!_isMock && client != null) {
      await client.from('transactions').insert({
        'child_id': childId,
        'amount': -penaltyAmount,
        'currency_type': rewardType,
        'transaction_type': 'penalty_deduction',
        'description': 'Ҷарима барои вазифаи фаромӯшшуда: "$taskTitle"',
      });
    }
  }
}
