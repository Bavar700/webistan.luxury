import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'child_dashboard_tab.dart';
import 'child_quests_tab.dart';
import 'child_store_tab.dart';
import '../../../../core/widgets/animated_background.dart';

class ChildMainScreen extends StatefulWidget {
  const ChildMainScreen({super.key});

  @override
  State<ChildMainScreen> createState() => _ChildMainScreenState();
}

class _ChildMainScreenState extends State<ChildMainScreen> {
  int _currentIndex = 0;

  final List<Widget> _tabs = [
    const ChildDashboardTab(),
    const ChildQuestsTab(),
    const ChildStoreTab(),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      extendBodyBehindAppBar: true,
      appBar: AppBar(
        backgroundColor: Colors.transparent,
        elevation: 0,
        title: const Text('Офарин! 🌟', style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold)),
        centerTitle: true,
        actions: [
          IconButton(
            icon: const Icon(Icons.swap_horiz, color: Colors.white70),
            onPressed: () => context.go('/parent'), // Switch to Parent Mode for testing
          ),
        ],
      ),
      body: AnimatedBackground(
        starCount: 60,
        child: SafeArea(
          bottom: false,
          child: IndexedStack(
            index: _currentIndex,
            children: _tabs,
          ),
        ),
      ),
      bottomNavigationBar: Container(
        decoration: BoxDecoration(
          color: const Color(0xFF1E2444),
          boxShadow: [
            BoxShadow(
              color: Colors.black.withValues(alpha: 0.3),
              blurRadius: 10,
              offset: const Offset(0, -2),
            ),
          ],
        ),
        child: SafeArea(
          child: BottomNavigationBar(
            backgroundColor: Colors.transparent,
            elevation: 0,
            selectedItemColor: const Color(0xFFFFD700), // Gold
            unselectedItemColor: Colors.white54,
            currentIndex: _currentIndex,
            onTap: (index) => setState(() => _currentIndex = index),
            items: const [
              BottomNavigationBarItem(icon: Icon(Icons.home), label: 'Асосӣ'),
              BottomNavigationBarItem(icon: Icon(Icons.assignment), label: 'Вазифаҳо'),
              BottomNavigationBarItem(icon: Icon(Icons.store), label: 'Дӯкон'),
            ],
          ),
        ),
      ),
    );
  }
}
