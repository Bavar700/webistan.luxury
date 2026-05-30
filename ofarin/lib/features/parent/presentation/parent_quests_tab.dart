import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import '../../../../core/state/app_state.dart';
import '../../../../core/models/task_model.dart';
import '../../../../core/widgets/glassmorphic_card.dart';

class ParentQuestsTab extends ConsumerStatefulWidget {
  const ParentQuestsTab({super.key});

  @override
  ConsumerState<ParentQuestsTab> createState() => _ParentQuestsTabState();
}

class _ParentQuestsTabState extends ConsumerState<ParentQuestsTab> {
  final _titleController = TextEditingController();
  int _selectedReward = 10;
  String _selectedCurrency = '⭐️';
  DateTime? _selectedDeadline;

  @override
  void dispose() {
    _titleController.dispose();
    super.dispose();
  }

  Future<void> _pickDateTime() async {
    final date = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime.now(),
      lastDate: DateTime.now().add(const Duration(days: 365)),
    );
    if (date == null) return;

    if (!mounted) return;
    final time = await showTimePicker(
      context: context,
      initialTime: TimeOfDay.now(),
    );
    if (time == null) return;

    setState(() {
      _selectedDeadline = DateTime(
        date.year,
        date.month,
        date.day,
        time.hour,
        time.minute,
      );
    });
  }

  void _submitTask() {
    if (_titleController.text.trim().isEmpty) return;

    final newTask = TaskModel(
      id: DateTime.now().millisecondsSinceEpoch.toString(),
      childId: 'child_1',
      parentId: 'parent_1',
      title: _titleController.text.trim(),
      description: '',
      rewardXp: _selectedCurrency == '⭐️' ? _selectedReward : 10,
      rewardCoins: _selectedCurrency == '🪙' ? _selectedReward : 5,
      deadlineAt: _selectedDeadline,
      createdAt: DateTime.now(),
      updatedAt: DateTime.now(),
    );
    
    ref.read(tasksProvider.notifier).addTask(newTask);
    
    // Reset form
    _titleController.clear();
    setState(() {
      _selectedReward = 10;
      _selectedDeadline = null;
    });
    
    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(content: Text('Вазифа таъин шуд!'), backgroundColor: Colors.green),
    );
  }

  @override
  Widget build(BuildContext context) {
    final tasks = ref.watch(tasksProvider);
    final activeTasks = tasks.where((t) => t.status != 'completed' && t.status != 'pending_approval').toList();

    return SingleChildScrollView(
      padding: const EdgeInsets.all(16.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text('Таъини Вазифаи Нав', style: TextStyle(color: Colors.white, fontSize: 20, fontWeight: FontWeight.bold)),
          const SizedBox(height: 16),
          GlassmorphicCard(
            padding: const EdgeInsets.all(16),
            opacity: 0.1,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                TextField(
                  controller: _titleController,
                  style: const TextStyle(color: Colors.white),
                  decoration: InputDecoration(
                    hintText: 'Номи вазифаро нависед...',
                    hintStyle: const TextStyle(color: Colors.white38),
                    filled: true,
                    fillColor: Colors.white.withValues(alpha: 0.05),
                    border: OutlineInputBorder(borderRadius: BorderRadius.circular(8), borderSide: BorderSide.none),
                  ),
                ),
                const SizedBox(height: 16),
                
                // Reward selector
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    const Text('Ҷоиза:', style: TextStyle(color: Colors.white70)),
                    Row(
                      children: [
                        IconButton(
                          icon: const Icon(Icons.remove_circle_outline, color: Colors.white),
                          onPressed: () {
                            if (_selectedReward > 5) setState(() => _selectedReward -= 5);
                          },
                        ),
                        Text('$_selectedReward', style: const TextStyle(color: Colors.white, fontSize: 18, fontWeight: FontWeight.bold)),
                        IconButton(
                          icon: const Icon(Icons.add_circle_outline, color: Colors.white),
                          onPressed: () {
                            if (_selectedReward < 100) setState(() => _selectedReward += 5);
                          },
                        ),
                      ],
                    ),
                  ],
                ),
                
                // Currency selector
                Row(
                  children: [
                    Expanded(
                      child: RadioListTile<String>(
                        title: const Text('⭐️', style: TextStyle(color: Colors.white)),
                        value: '⭐️',
                        groupValue: _selectedCurrency,
                        activeColor: Colors.amber,
                        contentPadding: EdgeInsets.zero,
                        onChanged: (val) => setState(() => _selectedCurrency = val!),
                      ),
                    ),
                    Expanded(
                      child: RadioListTile<String>(
                        title: const Text('🪙', style: TextStyle(color: Colors.white)),
                        value: '🪙',
                        groupValue: _selectedCurrency,
                        activeColor: Colors.amber,
                        contentPadding: EdgeInsets.zero,
                        onChanged: (val) => setState(() => _selectedCurrency = val!),
                      ),
                    ),
                  ],
                ),
                
                const SizedBox(height: 12),
                
                // Deadline selector
                InkWell(
                  onTap: _pickDateTime,
                  child: Container(
                    padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 12),
                    decoration: BoxDecoration(
                      border: Border.all(color: Colors.white24),
                      borderRadius: BorderRadius.circular(8),
                    ),
                    child: Row(
                      children: [
                        Icon(Icons.calendar_today, color: _selectedDeadline != null ? Colors.green : Colors.white70, size: 20),
                        const SizedBox(width: 8),
                        Expanded(
                          child: Text(
                            _selectedDeadline == null
                                ? 'Мӯҳлати иҷро (Ихтиёрӣ)'
                                : '${_selectedDeadline!.day.toString().padLeft(2, '0')}.${_selectedDeadline!.month.toString().padLeft(2, '0')}.${_selectedDeadline!.year} ${_selectedDeadline!.hour.toString().padLeft(2, '0')}:${_selectedDeadline!.minute.toString().padLeft(2, '0')}',
                            style: TextStyle(
                              color: _selectedDeadline != null ? Colors.white : Colors.white70,
                              fontSize: 14,
                            ),
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
                
                const SizedBox(height: 16),
                SizedBox(
                  width: double.infinity,
                  child: ElevatedButton(
                    onPressed: _submitTask,
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color(0xFFFFD700),
                      foregroundColor: Colors.black,
                      padding: const EdgeInsets.symmetric(vertical: 12),
                      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                    ),
                    child: const Text('Супориш додан', style: TextStyle(fontWeight: FontWeight.bold)),
                  ),
                ),
              ],
            ),
          ),
          
          const SizedBox(height: 32),
          
          const Text('Вазифаҳои Фаъол', style: TextStyle(color: Colors.white, fontSize: 20, fontWeight: FontWeight.bold)),
          const SizedBox(height: 16),
          ...activeTasks.map((task) => GlassmorphicCard(
            margin: const EdgeInsets.only(bottom: 8),
            padding: const EdgeInsets.all(12),
            opacity: 0.1,
            child: Row(
              children: [
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(task.title, style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
                      if (task.deadlineAt != null)
                        Text(
                          'Мӯҳлат: ${task.deadlineAt!.hour}:${task.deadlineAt!.minute.toString().padLeft(2, '0')}',
                          style: const TextStyle(color: Colors.redAccent, fontSize: 12),
                        ),
                    ],
                  ),
                ),
                Text('${task.rewardCoins} 🪙', style: const TextStyle(color: Colors.amber)),
              ],
            ),
          )),
        ],
      ),
    );
  }
}
