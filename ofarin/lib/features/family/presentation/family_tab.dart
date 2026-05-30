import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';

class FamilyTab extends StatelessWidget {
  final bool isParent;

  const FamilyTab({super.key, required this.isParent});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(16.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          const SizedBox(height: 20),
          // Profile Avatar
          Center(
            child: Container(
              width: 100,
              height: 100,
              decoration: BoxDecoration(
                color: Colors.white.withValues(alpha: 0.1),
                shape: BoxShape.circle,
                border: Border.all(color: const Color(0xFFFFC107), width: 2),
              ),
              child: const Icon(Icons.person, size: 60, color: Colors.white),
            ),
          ),
          const SizedBox(height: 16),
          Text(
            isParent ? 'Профили Волидайн' : 'Профили Кӯдак',
            style: const TextStyle(fontSize: 24, fontWeight: FontWeight.bold, color: Colors.white),
            textAlign: TextAlign.center,
          ),
          const SizedBox(height: 40),

          // Menu Items
          if (isParent) ...[
            _MenuItem(
              icon: Icons.child_care,
              title: 'Рӯйхати фарзандон',
              onTap: () {},
            ),
            const SizedBox(height: 12),
            _MenuItem(
              icon: Icons.person_add,
              title: 'Иловаи кӯдаки нав',
              onTap: () {},
            ),
            const SizedBox(height: 12),
          ],
          
          _MenuItem(
            icon: Icons.settings,
            title: 'Танзимот',
            onTap: () {},
          ),
          const Spacer(),

          // Logout
          ElevatedButton.icon(
            onPressed: () {
              // Clear session and go to Auth
              context.go('/auth');
            },
            icon: const Icon(Icons.logout),
            label: const Text('Баромадан (Logout)'),
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.redAccent.withValues(alpha: 0.2),
              foregroundColor: Colors.redAccent,
              elevation: 0,
              minimumSize: const Size.fromHeight(56),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(16),
                side: const BorderSide(color: Colors.redAccent),
              ),
            ),
          ),
          const SizedBox(height: 20),
        ],
      ),
    );
  }
}

class _MenuItem extends StatelessWidget {
  final IconData icon;
  final String title;
  final VoidCallback onTap;

  const _MenuItem({
    required this.icon,
    required this.title,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(16),
      child: Container(
        padding: const EdgeInsets.all(16),
        decoration: BoxDecoration(
          color: const Color(0xFF1E1E1E),
          borderRadius: BorderRadius.circular(16),
          border: Border.all(color: Colors.white10),
        ),
        child: Row(
          children: [
            Icon(icon, color: const Color(0xFFFFC107)),
            const SizedBox(width: 16),
            Text(title, style: const TextStyle(color: Colors.white, fontSize: 16)),
            const Spacer(),
            const Icon(Icons.arrow_forward_ios, color: Colors.grey, size: 16),
          ],
        ),
      ),
    );
  }
}
