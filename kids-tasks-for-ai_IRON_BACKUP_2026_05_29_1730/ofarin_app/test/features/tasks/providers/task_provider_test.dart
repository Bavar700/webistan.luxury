// ══════════════════════════════════════════════════════════════════════════════
// TaskProvider Unit Tests
// Tests all CRUD operations on TaskNotifier with a manual FakeApiClient
// ══════════════════════════════════════════════════════════════════════════════

import 'package:flutter_test/flutter_test.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';

import 'package:ofarin_app/core/network/api_client.dart' as client;
import 'package:ofarin_app/core/network/api_client_provider.dart';
import 'package:ofarin_app/core/constants/api_constants.dart';
import 'package:ofarin_app/features/tasks/presentation/providers/task_provider.dart';
import 'package:ofarin_app/features/tasks/data/models/task_model.dart';
import 'package:ofarin_app/features/tasks/data/enums/task_status.dart';

// ── Helper: builds the full JSON map that fromJson() expects ──────────────
// NOTE: TaskModel.toJson() intentionally excludes id/created_at/updated_at
//       because those are DB-generated. This helper re-adds them.
Map<String, dynamic> _taskToDbJson(TaskModel task) {
  return {
    'id': task.id,
    'child_id': task.childId,
    'parent_id': task.parentId,
    'title': task.title,
    'description': task.description,
    'is_bonus': task.isBonus,
    'timer_duration_mins': task.timerDurationMins,
    'deadline_at': task.deadlineAt?.toIso8601String(),
    'reward_amount': task.rewardAmount,
    'reward_currency': task.rewardCurrency,
    'penalty_amount': task.penaltyAmount,
    'penalty_currency': task.penaltyCurrency,
    'proof_image_url': task.proofImageUrl,
    'reject_reason': task.rejectReason,
    'status': task.status.value,
    'created_at': task.createdAt?.toIso8601String(),
    'updated_at': task.updatedAt?.toIso8601String(),
  };
}

// ══════════════════════════════════════════════════════════════════════════════
// FakeApiClient — Manual test double implementing ApiClientBase
// ══════════════════════════════════════════════════════════════════════════════

class _QueryCall {
  final String table;
  final String? column;
  final dynamic value;
  final String? orderBy;
  final bool ascending;

  const _QueryCall({
    required this.table,
    this.column,
    this.value,
    this.orderBy,
    this.ascending = true,
  });
}

class FakeApiClient implements client.ApiClientBase {
  // ── Configurable behaviour ──────────────────────────────────────────────
  List<Map<String, dynamic>> queryResult = [];
  Map<String, dynamic> insertResult = const {};
  Map<String, dynamic> updateResult = const {};
  bool throwOnQuery = false;
  bool throwOnInsert = false;
  bool throwOnUpdate = false;
  bool throwOnDelete = false;
  String errorMessage = 'Simulated error';

  // ── Call tracking ───────────────────────────────────────────────────────
  final List<_QueryCall> queryCalls = [];
  int insertCallCount = 0;
  List<Map<String, dynamic>> insertCallData = [];
  int updateCallCount = 0;
  List<Map<String, dynamic>> updateCallArgs = [];
  int deleteCallCount = 0;
  List<List<dynamic>> deleteCallArgs = [];

  // ── ApiClientBase implementation ────────────────────────────────────────

  @override
  String? get currentUserId => 'fake-user-id';

  @override
  String? get currentUserEmail => 'fake@test.com';

  @override
  Future<client.AuthResult> signUp(
    String email,
    String password, {
    Map<String, dynamic>? data,
  }) async {
    return client.AuthResult(userId: 'fake-user-id', metadata: data);
  }

  @override
  Future<client.AuthResult> signIn(String email, String password) async {
    return client.AuthResult(userId: 'fake-user-id');
  }

  @override
  Future<void> signOut() async {}

  @override
  Future<void> switchToChild() async {}

  @override
  Future<List<Map<String, dynamic>>> query(
    String table, {
    String? column,
    dynamic value,
    String? orderBy,
    bool ascending = true,
    int? limit,
  }) async {
    queryCalls.add(_QueryCall(
      table: table,
      column: column,
      value: value,
      orderBy: orderBy,
      ascending: ascending,
    ));
    if (throwOnQuery) throw Exception(errorMessage);
    return queryResult;
  }

  @override
  Future<List<Map<String, dynamic>>> queryMulti(
    String table,
    List<client.QueryFilter> filters, {
    String? orderBy,
    bool ascending = true,
    int? limit,
  }) async {
    return [];
  }

  @override
  Future<Map<String, dynamic>> insert(
      String table, Map<String, dynamic> data) async {
    insertCallCount++;
    insertCallData.add(data);
    if (throwOnInsert) throw Exception(errorMessage);
    return insertResult;
  }

  @override
  Future<Map<String, dynamic>> update(
    String table,
    Map<String, dynamic> data,
    String column,
    dynamic value,
  ) async {
    updateCallCount++;
    updateCallArgs.add({...data, '_column': column, '_value': value});
    if (throwOnUpdate) throw Exception(errorMessage);
    return updateResult;
  }

  @override
  Future<Map<String, dynamic>> upsert(
    String table,
    Map<String, dynamic> data,
    String column,
    dynamic value,
  ) async {
    return {};
  }

  @override
  Future<void> delete(String table, String column, dynamic value) async {
    deleteCallCount++;
    deleteCallArgs.add([table, column, value]);
    if (throwOnDelete) throw Exception(errorMessage);
  }
}

// ══════════════════════════════════════════════════════════════════════════════
// Test Data
// ══════════════════════════════════════════════════════════════════════════════

final _now = DateTime(2026, 5, 27, 14, 30, 0);

final _activeTask = TaskModel(
  id: 'task-1',
  childId: 'child-1',
  parentId: 'parent-1',
  title: 'Clean room',
  description: 'Clean your room thoroughly',
  rewardAmount: 5,
  rewardCurrency: 'star',
  penaltyAmount: 0,
  status: TaskStatus.active,
  createdAt: _now.subtract(const Duration(days: 1)),
);

final _pendingTask = TaskModel(
  id: 'task-2',
  childId: 'child-2',
  parentId: 'parent-1',
  title: 'Do homework',
  description: 'Math homework pages 10-15',
  isBonus: true,
  rewardAmount: 3,
  rewardCurrency: 'gold',
  penaltyAmount: 1,
  penaltyCurrency: 'star',
  status: TaskStatus.pendingApproval,
  proofImageUrl: 'uploads/photo.jpg',
  createdAt: _now,
);

final _completedTask = TaskModel(
  id: 'task-3',
  childId: 'child-1',
  parentId: 'parent-1',
  title: 'Walk the dog',
  description: 'Walk for 20 minutes',
  rewardAmount: 2,
  rewardCurrency: 'star',
  status: TaskStatus.completed,
  createdAt: _now.subtract(const Duration(days: 2)),
);

void main() {
  late FakeApiClient fakeApiClient;
  late ProviderContainer container;
  late TaskNotifier notifier;

  setUp(() {
    fakeApiClient = FakeApiClient();
    container = ProviderContainer(
      overrides: [
        apiClientProvider.overrideWithValue(fakeApiClient),
      ],
    );
    notifier = container.read(taskProvider.notifier);
  });

  tearDown(() {
    container.dispose();
  });

  // ── Initial State ───────────────────────────────────────────────────────

  group('initial state', () {
    test('starts with empty tasks, not loading, no error', () {
      final state = container.read(taskProvider);
      expect(state.tasks, isEmpty);
      expect(state.isLoading, isFalse);
      expect(state.error, isNull);
    });
  });

  // ── loadChildTasks ──────────────────────────────────────────────────────

  group('loadChildTasks', () {
    test('loads tasks for a child successfully', () async {
      fakeApiClient.queryResult = [
        _taskToDbJson(_activeTask),
        _taskToDbJson(_completedTask),
      ];

      await notifier.loadChildTasks('child-1');

      final state = container.read(taskProvider);
      expect(state.tasks.length, 2);
      expect(state.tasks[0].title, 'Clean room');
      expect(state.tasks[1].title, 'Walk the dog');
      expect(state.isLoading, isFalse);
      expect(state.error, isNull);

      // Verify correct Supabase query was made
      expect(fakeApiClient.queryCalls.length, 1);
      expect(fakeApiClient.queryCalls[0].table, ApiConstants.tasksTable);
      expect(fakeApiClient.queryCalls[0].column, 'child_id');
      expect(fakeApiClient.queryCalls[0].value, 'child-1');
      expect(fakeApiClient.queryCalls[0].orderBy, 'created_at');
      expect(fakeApiClient.queryCalls[0].ascending, isFalse);
    });

    test('sets loading state while fetching', () async {
      fakeApiClient.queryResult = [_taskToDbJson(_activeTask)];

      // Start loading but don't await yet
      final future = notifier.loadChildTasks('child-1');

      // loadChildTasks sets isLoading synchronously before the first await
      expect(container.read(taskProvider).isLoading, isTrue);

      await future;
      expect(container.read(taskProvider).isLoading, isFalse);
    });

    test('handles error gracefully', () async {
      fakeApiClient.throwOnQuery = true;
      fakeApiClient.errorMessage = 'Network error';

      await notifier.loadChildTasks('child-1');

      final state = container.read(taskProvider);
      expect(state.tasks, isEmpty);
      expect(state.isLoading, isFalse);
      expect(state.error, isNotNull);
    });
  });

  // ── loadPendingTasks ────────────────────────────────────────────────────

  group('loadPendingTasks', () {
    test('loads only pending_approval tasks for a parent', () async {
      fakeApiClient.queryResult = [
        _taskToDbJson(_activeTask),
        _taskToDbJson(_pendingTask),
        _taskToDbJson(_completedTask),
      ];

      await notifier.loadPendingTasks('parent-1');

      final state = container.read(taskProvider);
      expect(state.tasks.length, 1);
      expect(state.tasks[0].id, 'task-2');
      expect(state.tasks[0].status, TaskStatus.pendingApproval);
      expect(state.error, isNull);

      expect(fakeApiClient.queryCalls.length, 1);
      expect(fakeApiClient.queryCalls[0].column, 'parent_id');
      expect(fakeApiClient.queryCalls[0].value, 'parent-1');
    });

    test('returns empty list when no pending tasks', () async {
      fakeApiClient.queryResult = [
        _taskToDbJson(_activeTask),
        _taskToDbJson(_completedTask),
      ];

      await notifier.loadPendingTasks('parent-1');

      final state = container.read(taskProvider);
      expect(state.tasks, isEmpty);
      expect(state.error, isNull);
    });

    test('handles error gracefully', () async {
      fakeApiClient.throwOnQuery = true;

      await notifier.loadPendingTasks('parent-1');

      final state = container.read(taskProvider);
      expect(state.tasks, isEmpty);
      expect(state.isLoading, isFalse);
      expect(state.error, isNotNull);
    });
  });

  // ── loadParentTasks ─────────────────────────────────────────────────────

  group('loadParentTasks', () {
    test('loads all tasks for a parent successfully', () async {
      fakeApiClient.queryResult = [
        _taskToDbJson(_activeTask),
        _taskToDbJson(_pendingTask),
        _taskToDbJson(_completedTask),
      ];

      await notifier.loadParentTasks('parent-1');

      final state = container.read(taskProvider);
      expect(state.tasks.length, 3);
      expect(state.error, isNull);

      expect(fakeApiClient.queryCalls[0].column, 'parent_id');
      expect(fakeApiClient.queryCalls[0].value, 'parent-1');
    });

    test('handles error gracefully', () async {
      fakeApiClient.throwOnQuery = true;

      await notifier.loadParentTasks('parent-1');

      final state = container.read(taskProvider);
      expect(state.tasks, isEmpty);
      expect(state.error, isNotNull);
    });
  });

  // ── createTask ──────────────────────────────────────────────────────────

  group('createTask', () {
    test('creates a task and returns it', () async {
      fakeApiClient.insertResult = _taskToDbJson(_activeTask);

      final result = await notifier.createTask(_activeTask);

      expect(result, isNotNull);
      expect(result!.id, 'task-1');
      expect(result.title, 'Clean room');

      final state = container.read(taskProvider);
      expect(state.tasks.length, 1);
      expect(state.tasks[0].id, 'task-1');
      expect(state.error, isNull);

      expect(fakeApiClient.insertCallCount, 1);
      expect(fakeApiClient.insertCallData[0]['title'], 'Clean room');
    });

    test('prepends new task to the list', () async {
      // First load an existing task
      fakeApiClient.queryResult = [_taskToDbJson(_completedTask)];
      await notifier.loadChildTasks('child-1');
      expect(container.read(taskProvider).tasks.length, 1);

      // Then create a new task
      fakeApiClient.insertResult = _taskToDbJson(_activeTask);
      await notifier.createTask(_activeTask);

      final state = container.read(taskProvider);
      expect(state.tasks.length, 2);
      // New task should be first (prepended)
      expect(state.tasks[0].id, 'task-1');
      expect(state.tasks[0].status, TaskStatus.active);
    });

    test('returns null and sets error on failure', () async {
      fakeApiClient.throwOnInsert = true;

      final result = await notifier.createTask(_activeTask);

      expect(result, isNull);
      expect(container.read(taskProvider).error, isNotNull);
    });
  });

  // ── approveTask ─────────────────────────────────────────────────────────

  group('approveTask', () {
    test('approves a pending task and updates state', () async {
      fakeApiClient.queryResult = [_taskToDbJson(_pendingTask)];
      await notifier.loadPendingTasks('parent-1');
      expect(
        container.read(taskProvider).tasks[0].status,
        TaskStatus.pendingApproval,
      );

      await notifier.approveTask('task-2');

      final state = container.read(taskProvider);
      expect(state.tasks[0].status, TaskStatus.completed);
      expect(state.error, isNull);

      // Verify update was called with correct params
      expect(fakeApiClient.updateCallCount, 1);
      expect(fakeApiClient.updateCallArgs[0]['_column'], 'id');
      expect(fakeApiClient.updateCallArgs[0]['_value'], 'task-2');
      expect(fakeApiClient.updateCallArgs[0]['status'], 'completed');
    });

    test('handles error on approve', () async {
      fakeApiClient.queryResult = [_taskToDbJson(_pendingTask)];
      await notifier.loadPendingTasks('parent-1');
      notifier.clearError();

      fakeApiClient.throwOnUpdate = true;
      await notifier.approveTask('task-2');

      expect(container.read(taskProvider).error, isNotNull);
    });
  });

  // ── rejectTask ──────────────────────────────────────────────────────────

  group('rejectTask', () {
    test('rejects a pending task with reason and updates state', () async {
      fakeApiClient.queryResult = [_taskToDbJson(_pendingTask)];
      await notifier.loadPendingTasks('parent-1');

      await notifier.rejectTask('task-2', 'Not done properly');

      final state = container.read(taskProvider);
      expect(state.tasks[0].status, TaskStatus.rejected);
      expect(state.tasks[0].rejectReason, 'Not done properly');
      expect(state.error, isNull);

      expect(fakeApiClient.updateCallCount, 1);
      expect(fakeApiClient.updateCallArgs[0]['status'], 'rejected');
      expect(fakeApiClient.updateCallArgs[0]['reject_reason'], 'Not done properly');
    });

    test('handles error on reject', () async {
      fakeApiClient.queryResult = [_taskToDbJson(_pendingTask)];
      await notifier.loadPendingTasks('parent-1');
      notifier.clearError();

      fakeApiClient.throwOnUpdate = true;
      await notifier.rejectTask('task-2', 'Reason');

      expect(container.read(taskProvider).error, isNotNull);
    });
  });

  // ── submitForApproval ───────────────────────────────────────────────────

  group('submitForApproval', () {
    test('submits task with proof image and updates state', () async {
      fakeApiClient.queryResult = [_taskToDbJson(_activeTask)];
      await notifier.loadChildTasks('child-1');

      await notifier.submitForApproval('task-1', 'proof.jpg');

      final state = container.read(taskProvider);
      expect(state.tasks[0].status, TaskStatus.pendingApproval);
      expect(state.tasks[0].proofImageUrl, 'proof.jpg');
      expect(state.error, isNull);

      expect(fakeApiClient.updateCallCount, 1);
      expect(fakeApiClient.updateCallArgs[0]['status'], 'pending_approval');
      expect(fakeApiClient.updateCallArgs[0]['proof_image_url'], 'proof.jpg');
    });

    test('handles error on submit', () async {
      fakeApiClient.queryResult = [_taskToDbJson(_activeTask)];
      await notifier.loadChildTasks('child-1');
      notifier.clearError();

      fakeApiClient.throwOnUpdate = true;
      await notifier.submitForApproval('task-1', 'proof.jpg');

      expect(container.read(taskProvider).error, isNotNull);
    });
  });

  // ── deleteTask ──────────────────────────────────────────────────────────

  group('deleteTask', () {
    test('deletes a task and removes it from state', () async {
      fakeApiClient.queryResult = [
        _taskToDbJson(_activeTask),
        _taskToDbJson(_pendingTask),
      ];
      await notifier.loadChildTasks('child-1');
      expect(container.read(taskProvider).tasks.length, 2);

      await notifier.deleteTask('task-1');

      final state = container.read(taskProvider);
      expect(state.tasks.length, 1);
      expect(state.tasks[0].id, 'task-2');
      expect(state.error, isNull);

      expect(fakeApiClient.deleteCallCount, 1);
      expect(fakeApiClient.deleteCallArgs[0], [
        ApiConstants.tasksTable,
        'id',
        'task-1',
      ]);
    });

    test('handles error on delete', () async {
      fakeApiClient.queryResult = [_taskToDbJson(_activeTask)];
      await notifier.loadChildTasks('child-1');

      fakeApiClient.throwOnDelete = true;
      await notifier.deleteTask('task-1');

      // Task should still be in state since delete failed
      expect(container.read(taskProvider).tasks.length, 1);
      expect(container.read(taskProvider).error, isNotNull);
    });
  });

  // ── clearError ──────────────────────────────────────────────────────────

  group('clearError', () {
    test('clears the error state', () async {
      fakeApiClient.throwOnQuery = true;
      await notifier.loadChildTasks('child-1');
      expect(container.read(taskProvider).error, isNotNull);

      notifier.clearError();
      expect(container.read(taskProvider).error, isNull);
    });
  });

  // ── Multiple Operations ─────────────────────────────────────────────────

  group('multiple operations', () {
    test('handles create then load cycle', () async {
      // Create a task
      fakeApiClient.insertResult = _taskToDbJson(_activeTask);
      await notifier.createTask(_activeTask);

      // Load again (simulating fresh data from DB)
      fakeApiClient.queryResult = [
        _taskToDbJson(_activeTask),
        _taskToDbJson(_pendingTask),
      ];
      await notifier.loadChildTasks('child-1');

      final state = container.read(taskProvider);
      expect(state.tasks.length, 2);
      expect(state.error, isNull);
    });

    test('handles approve then reject flow', () async {
      // Load two pending tasks
      final taskA = _pendingTask;
      final taskB = _pendingTask.copyWith(id: 'task-b', title: 'Task B');

      fakeApiClient.queryResult = [_taskToDbJson(taskA), _taskToDbJson(taskB)];
      await notifier.loadPendingTasks('parent-1');
      expect(container.read(taskProvider).tasks.length, 2);

      // Approve the first
      await notifier.approveTask('task-2');
      expect(container.read(taskProvider).tasks[0].status, TaskStatus.completed);

      // Reject the second
      await notifier.rejectTask('task-b', 'Incomplete');
      expect(container.read(taskProvider).tasks[1].status, TaskStatus.rejected);
      expect(container.read(taskProvider).tasks[1].rejectReason, 'Incomplete');
    });
  });
}
