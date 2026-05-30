// ══════════════════════════════════════════════════════════════════════════════
// Task Provider — Real Supabase CRUD state management for tasks
// ══════════════════════════════════════════════════════════════════════════════

import 'package:flutter_riverpod/flutter_riverpod.dart';
import 'package:uuid/uuid.dart';
import '../../../../core/constants/api_constants.dart';
import '../../../../core/network/api_client.dart';
import '../../../../core/network/api_client_provider.dart';
import '../../data/models/task_model.dart';
import '../../data/enums/task_status.dart';

/// Represents the task list state
class TaskState {
  final List<TaskModel> tasks;
  final bool isLoading;
  final String? error;

  const TaskState({
    this.tasks = const [],
    this.isLoading = false,
    this.error,
  });

  TaskState copyWith({
    List<TaskModel>? tasks,
    bool? isLoading,
    String? error,
  }) {
    return TaskState(
      tasks: tasks ?? this.tasks,
      isLoading: isLoading ?? this.isLoading,
      error: error,
    );
  }
}

class TaskNotifier extends StateNotifier<TaskState> {
  final ApiClientBase _apiClient;

  TaskNotifier(this._apiClient) : super(const TaskState());

  /// Load tasks for a specific child (for child dashboard)
  Future<void> loadChildTasks(String childId) async {
    state = state.copyWith(isLoading: true, error: null);
    try {
      final data = await _apiClient.query(
        ApiConstants.tasksTable,
        column: 'child_id',
        value: childId,
        orderBy: 'created_at',
        ascending: false,
      );
      final tasks = data.map((json) => TaskModel.fromJson(json)).toList();
      state = TaskState(tasks: tasks);
    } catch (e) {
      state = TaskState(error: e.toString());
    }
  }

  /// Load tasks pending approval for a parent
  Future<void> loadPendingTasks(String parentId) async {
    state = state.copyWith(isLoading: true, error: null);
    try {
      final data = await _apiClient.query(
        ApiConstants.tasksTable,
        column: 'parent_id',
        value: parentId,
        orderBy: 'updated_at',
        ascending: false,
      );
      final pending = data
          .where((j) => j['status'] == 'pending_approval')
          .map((json) => TaskModel.fromJson(json))
          .toList();
      state = TaskState(tasks: pending);
    } catch (e) {
      state = TaskState(error: e.toString());
    }
  }

  /// Load all tasks for a parent (for overview)
  Future<void> loadParentTasks(String parentId) async {
    state = state.copyWith(isLoading: true, error: null);
    try {
      final data = await _apiClient.query(
        ApiConstants.tasksTable,
        column: 'parent_id',
        value: parentId,
        orderBy: 'created_at',
        ascending: false,
      );
      final tasks = data.map((json) => TaskModel.fromJson(json)).toList();
      state = TaskState(tasks: tasks);
    } catch (e) {
      state = TaskState(error: e.toString());
    }
  }

  /// Create a new task in Supabase
  Future<TaskModel?> createTask(TaskModel task) async {
    try {
      final result = await _apiClient.insert(
        ApiConstants.tasksTable,
        {
          ...task.toJson(),
          'id': const Uuid().v4(),
        },
      );
      final created = TaskModel.fromJson(result);
      state = state.copyWith(tasks: [created, ...state.tasks]);
      return created;
    } catch (e) {
      state = state.copyWith(error: e.toString());
      return null;
    }
  }

  /// Approve a task (parent action — marks as completed)
  Future<void> approveTask(String taskId) async {
    try {
      await _apiClient.update(
        ApiConstants.tasksTable,
        {'status': 'completed'},
        'id',
        taskId,
      );
      state = state.copyWith(
        tasks: state.tasks.map((t) {
          if (t.id == taskId) {
            return t.copyWith(status: TaskStatus.completed);
          }
          return t;
        }).toList(),
      );
    } catch (e) {
      state = state.copyWith(error: e.toString());
    }
  }

  /// Reject a task (parent action)
  Future<void> rejectTask(String taskId, String reason) async {
    try {
      await _apiClient.update(
        ApiConstants.tasksTable,
        {'status': 'rejected', 'reject_reason': reason},
        'id',
        taskId,
      );
      state = state.copyWith(
        tasks: state.tasks.map((t) {
          if (t.id == taskId) {
            return t.copyWith(status: TaskStatus.rejected, rejectReason: reason);
          }
          return t;
        }).toList(),
      );
    } catch (e) {
      state = state.copyWith(error: e.toString());
    }
  }

  /// Child submits task for approval with proof image
  Future<void> submitForApproval(String taskId, String proofImageUrl) async {
    try {
      await _apiClient.update(
        ApiConstants.tasksTable,
        {
          'status': 'pending_approval',
          'proof_image_url': proofImageUrl,
        },
        'id',
        taskId,
      );
      state = state.copyWith(
        tasks: state.tasks.map((t) {
          if (t.id == taskId) {
            return t.copyWith(
              status: TaskStatus.pendingApproval,
              proofImageUrl: proofImageUrl,
            );
          }
          return t;
        }).toList(),
      );
    } catch (e) {
      state = state.copyWith(error: e.toString());
    }
  }

  /// Delete a task
  Future<void> deleteTask(String taskId) async {
    try {
      await _apiClient.delete(ApiConstants.tasksTable, 'id', taskId);
      state = state.copyWith(
        tasks: state.tasks.where((t) => t.id != taskId).toList(),
      );
    } catch (e) {
      state = state.copyWith(error: e.toString());
    }
  }

  /// Clear any error
  void clearError() {
    state = state.copyWith(error: null);
  }
}

final taskProvider = StateNotifierProvider<TaskNotifier, TaskState>((ref) {
  final apiClient = ref.watch(apiClientProvider);
  return TaskNotifier(apiClient);
});
