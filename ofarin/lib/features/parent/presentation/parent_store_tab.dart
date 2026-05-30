import 'package:flutter/material.dart';
import 'package:flutter_riverpod/flutter_riverpod.dart';
import '../../../../core/state/app_state.dart';
import '../../../../core/models/reward_model.dart';
import '../../../../core/widgets/glassmorphic_card.dart';

class ParentStoreTab extends ConsumerStatefulWidget {
  const ParentStoreTab({super.key});

  @override
  ConsumerState<ParentStoreTab> createState() => _ParentStoreTabState();
}

class _ParentStoreTabState extends ConsumerState<ParentStoreTab> {
  final _titleController = TextEditingController();
  int _selectedPrice = 50;

  @override
  void dispose() {
    _titleController.dispose();
    super.dispose();
  }

  void _addReward() {
    if (_titleController.text.trim().isEmpty) return;

    final newReward = RewardModel(
      id: DateTime.now().millisecondsSinceEpoch.toString(),
      title: _titleController.text.trim(),
      price: _selectedPrice,
      currency: '🪙',
      category: 'toy',
    );

    ref.read(rewardsProvider.notifier).addReward(newReward);
    
    _titleController.clear();
    setState(() {
      _selectedPrice = 50;
    });

    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(content: Text('Ҷоиза илова шуд!'), backgroundColor: Colors.green),
    );
  }

  @override
  Widget build(BuildContext context) {
    final rewards = ref.watch(rewardsProvider);

    return SingleChildScrollView(
      padding: const EdgeInsets.all(16.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text('Иловаи Ҷоиза', style: TextStyle(color: Colors.white, fontSize: 20, fontWeight: FontWeight.bold)),
          const SizedBox(height: 16),
          
          GlassmorphicCard(
            padding: const EdgeInsets.all(16),
            opacity: 0.1,
            child: Column(
              children: [
                TextField(
                  controller: _titleController,
                  style: const TextStyle(color: Colors.white),
                  decoration: InputDecoration(
                    hintText: 'Номи ҷоиза...',
                    hintStyle: const TextStyle(color: Colors.white38),
                    filled: true,
                    fillColor: Colors.white.withValues(alpha: 0.05),
                    border: OutlineInputBorder(borderRadius: BorderRadius.circular(8), borderSide: BorderSide.none),
                  ),
                ),
                const SizedBox(height: 16),
                
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    const Text('Нарх:', style: TextStyle(color: Colors.white70)),
                    Row(
                      children: [
                        IconButton(
                          icon: const Icon(Icons.remove_circle_outline, color: Colors.white),
                          onPressed: () {
                            if (_selectedPrice > 10) setState(() => _selectedPrice -= 10);
                          },
                        ),
                        Text('$_selectedPrice 🪙', style: const TextStyle(color: Colors.amber, fontSize: 18, fontWeight: FontWeight.bold)),
                        IconButton(
                          icon: const Icon(Icons.add_circle_outline, color: Colors.white),
                          onPressed: () {
                            if (_selectedPrice < 1000) setState(() => _selectedPrice += 10);
                          },
                        ),
                      ],
                    ),
                  ],
                ),
                
                const SizedBox(height: 16),
                SizedBox(
                  width: double.infinity,
                  child: ElevatedButton(
                    onPressed: _addReward,
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color(0xFF4FC3F7),
                      foregroundColor: Colors.black,
                      padding: const EdgeInsets.symmetric(vertical: 12),
                      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
                    ),
                    child: const Text('Илова кардан', style: TextStyle(fontWeight: FontWeight.bold)),
                  ),
                ),
              ],
            ),
          ),
          
          const SizedBox(height: 32),
          const Text('Ҷоизаҳои Мавҷуда', style: TextStyle(color: Colors.white, fontSize: 20, fontWeight: FontWeight.bold)),
          const SizedBox(height: 16),
          
          GridView.builder(
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
              crossAxisCount: 2,
              crossAxisSpacing: 12,
              mainAxisSpacing: 12,
              childAspectRatio: 0.8,
            ),
            itemCount: rewards.length,
            itemBuilder: (context, index) {
              final reward = rewards[index];
              return GlassmorphicCard(
                padding: const EdgeInsets.all(12),
                opacity: 0.1,
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    const Text('🎁', style: TextStyle(fontSize: 32)),
                    const Spacer(),
                    Text(
                      reward.title,
                      style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
                      textAlign: TextAlign.center,
                    ),
                    const SizedBox(height: 8),
                    Text('${reward.price} 🪙', style: const TextStyle(color: Colors.amber, fontWeight: FontWeight.bold)),
                    const Spacer(),
                    OutlinedButton(
                      onPressed: () {
                        // TODO: Implement delete
                      },
                      style: OutlinedButton.styleFrom(
                        side: const BorderSide(color: Colors.redAccent),
                        padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                        minimumSize: Size.zero,
                      ),
                      child: const Text('Узв кардан', style: TextStyle(color: Colors.redAccent, fontSize: 10)),
                    ),
                  ],
                ),
              );
            },
          ),
        ],
      ),
    );
  }
}
