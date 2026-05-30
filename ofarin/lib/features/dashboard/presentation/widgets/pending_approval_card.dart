import 'package:flutter/material.dart';
import '../../../../core/models/task_model.dart';
import '../../../../core/widgets/glassmorphic_card.dart';

class PendingApprovalCard extends StatelessWidget {
  final TaskModel task;
  final String childName;
  final VoidCallback onApprove;
  final VoidCallback onReject;

  const PendingApprovalCard({
    super.key,
    required this.task,
    required this.childName,
    required this.onApprove,
    required this.onReject,
  });

  @override
  Widget build(BuildContext context) {
    return GlassmorphicCard(
      margin: const EdgeInsets.only(bottom: 16),
      opacity: 0.2,
      borderColor: Colors.orange,
      padding: const EdgeInsets.all(16),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Container(
                padding: const EdgeInsets.all(8),
                decoration: BoxDecoration(
                  color: Colors.orange.withOpacity(0.2),
                  shape: BoxShape.circle,
                ),
                child: const Text('⏳', style: TextStyle(fontSize: 24)),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      task.title,
                      style: const TextStyle(
                        color: Colors.white,
                        fontSize: 16,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    Text(
                      'Аз тарафи $childName иҷро шуд',
                      style: TextStyle(
                        color: Colors.white.withOpacity(0.7),
                        fontSize: 12,
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
          const SizedBox(height: 16),
          // Proof Image if exists
          if (task.proofImageUrl != null) ...[
            ClipRRect(
              borderRadius: BorderRadius.circular(12),
              child: Image.network(
                task.proofImageUrl!,
                height: 120,
                width: double.infinity,
                fit: BoxFit.cover,
                errorBuilder: (context, error, stackTrace) => Container(
                  height: 120,
                  width: double.infinity,
                  color: Colors.white.withOpacity(0.1),
                  child: const Center(
                    child: Text('Акс ёфт нашуд', style: TextStyle(color: Colors.white54)),
                  ),
                ),
              ),
            ),
            const SizedBox(height: 16),
          ],
          
          // Action Buttons
          Row(
            children: [
              Expanded(
                child: OutlinedButton.icon(
                  onPressed: onReject,
                  icon: const Icon(Icons.close, color: Colors.redAccent),
                  label: const FittedBox(child: Text('Рад кардан', style: TextStyle(color: Colors.redAccent))),
                  style: OutlinedButton.styleFrom(
                    side: const BorderSide(color: Colors.redAccent),
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
                  ),
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: ElevatedButton.icon(
                  onPressed: onApprove,
                  icon: const Icon(Icons.check, color: Colors.white),
                  label: const FittedBox(child: Text('Қабул', style: TextStyle(color: Colors.white))),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.green,
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
                  ),
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }
}
