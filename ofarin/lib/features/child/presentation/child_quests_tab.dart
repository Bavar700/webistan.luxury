import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import '../../../../core/state/app_state.dart';
import '../../../../core/widgets/glassmorphic_card.dart';

class ChildQuestsTab extends ConsumerWidget {
  const ChildQuestsTab({super.key});

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final tasks = ref.watch(tasksProvider);
    final activeTasks = tasks.where((t) => t.status != 'completed').toList();

    return Padding(
      padding: const EdgeInsets.all(16.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text(
            'Квестҳои Имрӯза ⚔️',
            style: TextStyle(color: Colors.white, fontSize: 24, fontWeight: FontWeight.bold),
          ),
          const SizedBox(height: 16),
          Expanded(
            child: activeTasks.isEmpty
                ? const Center(
                    child: Text(
                      'Ҳамаи вазифаҳо иҷро шудаанд! 🎉',
                      style: TextStyle(color: Colors.white70, fontSize: 16),
                    ),
                  )
                : ListView.builder(
                    itemCount: activeTasks.length,
                    itemBuilder: (context, index) {
                      final task = activeTasks[index];
                      final isPending = task.status == 'pending_approval';

                      return GlassmorphicCard(
                        margin: const EdgeInsets.only(bottom: 12),
                        padding: const EdgeInsets.all(16),
                        opacity: isPending ? 0.1 : 0.2,
                        child: Row(
                          children: [
                            Container(
                              padding: const EdgeInsets.all(12),
                              decoration: BoxDecoration(
                                color: isPending ? Colors.orange.withValues(alpha: 0.2) : Colors.blue.withValues(alpha: 0.2),
                                shape: BoxShape.circle,
                              ),
                              child: Text(isPending ? '⏳' : '🎯', style: const TextStyle(fontSize: 24)),
                            ),
                            const SizedBox(width: 16),
                            Expanded(
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Text(
                                    task.title,
                                    style: TextStyle(
                                      color: isPending ? Colors.white54 : Colors.white,
                                      fontSize: 16,
                                      fontWeight: FontWeight.bold,
                                      decoration: isPending ? TextDecoration.lineThrough : null,
                                    ),
                                  ),
                                  const SizedBox(height: 4),
                                  Row(
                                    children: [
                                      Text('${task.rewardXp} ⭐️', style: const TextStyle(color: Colors.blueAccent, fontSize: 12)),
                                      const SizedBox(width: 8),
                                      Text('${task.rewardCoins} 🪙', style: const TextStyle(color: Colors.amber, fontSize: 12)),
                                    ],
                                  ),
                                ],
                              ),
                            ),
                            if (!isPending)
                              ElevatedButton(
                                onPressed: () {
                                  _showSubmitDialog(context, ref, task.id);
                                },
                                style: ElevatedButton.styleFrom(
                                  backgroundColor: const Color(0xFFFFD700),
                                  foregroundColor: Colors.black,
                                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
                                ),
                                child: const Text('Иҷро'),
                              )
                            else
                              const Text('Дар интизор', style: TextStyle(color: Colors.orange, fontSize: 12)),
                          ],
                        ),
                      );
                    },
                  ),
          ),
        ],
      ),
    );
  }

  void _showSubmitDialog(BuildContext context, WidgetRef ref, String taskId) {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        backgroundColor: const Color(0xFF1E2444),
        title: const Text('Вазифаро фиристодан?', style: TextStyle(color: Colors.white)),
        content: const Text(
          'Оё мутмаин ҳастед, ки вазифаро пурра иҷро кардед? Волидон онро тафтиш мекунанд!',
          style: TextStyle(color: Colors.white70),
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Не', style: TextStyle(color: Colors.white54)),
          ),
          ElevatedButton(
            onPressed: () {
              ref.read(tasksProvider.notifier).submitTask(taskId);
              Navigator.pop(context);
              ScaffoldMessenger.of(context).showSnackBar(
                const SnackBar(content: Text('Ба волидайн фиристода шуд!'), backgroundColor: Colors.green),
              );
            },
            style: ElevatedButton.styleFrom(backgroundColor: Colors.green),
            child: const Text('Бале, фиристодан', style: TextStyle(color: Colors.white)),
          ),
        ],
      ),
    );
  }
}
