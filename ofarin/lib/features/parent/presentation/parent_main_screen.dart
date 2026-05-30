import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'parent_dashboard_tab.dart';
import 'parent_quests_tab.dart';
import 'parent_store_tab.dart';

class ParentMainScreen extends StatefulWidget {
  const ParentMainScreen({super.key});

  @override
  State<ParentMainScreen> createState() => _ParentMainScreenState();
}

class _ParentMainScreenState extends State<ParentMainScreen> {
  int _currentIndex = 0;

  final List<Widget> _tabs = [
    const ParentDashboardTab(),
    const ParentQuestsTab(),
    const ParentStoreTab(),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF0A0E21),
      appBar: AppBar(
        backgroundColor: const Color(0xFF1E2444),
        title: const Text('Волидайн 👑', style: TextStyle(color: Colors.white)),
        centerTitle: true,
        actions: [
          TextButton(
            onPressed: () => context.go('/child'), // Switch to Child Mode
            child: const Text('Кӯдак', style: TextStyle(color: Colors.amber)),
          ),
        ],
      ),
      body: SafeArea(
        child: IndexedStack(
          index: _currentIndex,
          children: _tabs,
        ),
      ),
      bottomNavigationBar: BottomNavigationBar(
        backgroundColor: const Color(0xFF1E2444),
        selectedItemColor: const Color(0xFFFFD700),
        unselectedItemColor: Colors.white54,
        currentIndex: _currentIndex,
        onTap: (index) => setState(() => _currentIndex = index),
        type: BottomNavigationBarType.fixed,
        items: const [
          BottomNavigationBarItem(icon: Icon(Icons.dashboard), label: 'Асосӣ'),
          BottomNavigationBarItem(icon: Icon(Icons.list_alt), label: 'Вазифаҳо'),
          BottomNavigationBarItem(icon: Icon(Icons.card_giftcard), label: 'Ҷоизаҳо'),
        ],
      ),
    );
  }
}
