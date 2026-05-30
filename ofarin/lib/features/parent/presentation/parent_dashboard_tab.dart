import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import '../../../../core/state/app_state.dart';
import '../../../../core/widgets/glassmorphic_card.dart';
import '../../../../core/models/task_model.dart';

class ParentDashboardTab extends ConsumerWidget {
  const ParentDashboardTab({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final tasks = ref.watch(tasksProvider);
    final user = ref.watch(userProvider);
    
    final pendingTasks = tasks.where((t) => t.status == 'pending_approval').toList();
    final completedTasks = tasks.where((t) => t.status == 'completed').toList();
    
    int totalXpEarned = completedTasks.fold(0, (sum, task) => sum + task.rewardXp);

    return SingleChildScrollView(
      padding: const EdgeInsets.all(16.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          // Child Summary Card
          if (user != null)
            GlassmorphicCard(
              padding: const EdgeInsets.all(16),
              opacity: 0.1,
              child: Row(
                children: [
                  Text(user.avatarEmoji, style: const TextStyle(fontSize: 40)),
                  const SizedBox(width: 16),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(user.name, style: const TextStyle(color: Colors.white, fontSize: 18, fontWeight: FontWeight.bold)),
                        Text('Сатҳи ${user.level}', style: const TextStyle(color: Colors.amber)),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          const SizedBox(height: 24),
          
          // Weekly Stats
          Row(
            children: [
              Expanded(
                child: _buildStatCard('Иҷрошуда', '${completedTasks.length}', Colors.green),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: _buildStatCard('XP-и умумӣ', '$totalXpEarned', Colors.blueAccent),
              ),
            ],
          ),
          
          const SizedBox(height: 32),
          
          const Text('Интизори тасдиқ', style: TextStyle(color: Colors.white, fontSize: 20, fontWeight: FontWeight.bold)),
          const SizedBox(height: 16),
          
          if (pendingTasks.isEmpty)
            const Center(
              child: Padding(
                padding: EdgeInsets.all(32.0),
                child: Text('Ҳеҷ вазифае барои тасдиқ нест.', style: TextStyle(color: Colors.white54)),
              ),
            )
          else
            ...pendingTasks.map((task) => _buildPendingCard(context, ref, task)),
        ],
      ),
    );
  }

  Widget _buildStatCard(String title, String value, Color color) {
    return GlassmorphicCard(
      padding: const EdgeInsets.all(16),
      opacity: 0.1,
      child: Column(
        children: [
          Text(value, style: TextStyle(color: color, fontSize: 24, fontWeight: FontWeight.bold)),
          const SizedBox(height: 4),
          Text(title, style: const TextStyle(color: Colors.white70, fontSize: 12)),
        ],
      ),
    );
  }

  Widget _buildPendingCard(BuildContext context, WidgetRef ref, TaskModel task) {
    return GlassmorphicCard(
      margin: const EdgeInsets.only(bottom: 12),
      padding: const EdgeInsets.all(16),
      borderColor: Colors.orange,
      opacity: 0.1,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              const Text('⏳', style: TextStyle(fontSize: 24)),
              const SizedBox(width: 12),
              Expanded(
                child: Text(
                  task.title,
                  style: const TextStyle(color: Colors.white, fontSize: 16, fontWeight: FontWeight.bold),
                ),
              ),
            ],
          ),
          const SizedBox(height: 16),
          Row(
            children: [
              Expanded(
                child: OutlinedButton(
                  onPressed: () {
                    ref.read(tasksProvider.notifier).rejectTask(task.id, 'Рад карда шуд');
                  },
                  style: OutlinedButton.styleFrom(
                    side: const BorderSide(color: Colors.redAccent),
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                  ),
                  child: const FittedBox(child: Text('Рад кардан', style: TextStyle(color: Colors.redAccent))),
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: ElevatedButton(
                  onPressed: () {
                    final wallet = ref.read(walletProvider.notifier);
                    final user = ref.read(userProvider.notifier);
                    ref.read(tasksProvider.notifier).approveTask(task.id, wallet, user);
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.green,
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                  ),
                  child: const FittedBox(child: Text('Қабул', style: TextStyle(color: Colors.white))),
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }
}
