import 'package:flutter/material.dart';
import 'package:easy_localization/easy_localization.dart';
import 'package:go_router/go_router.dart';

class LanguagePickerScreen extends StatefulWidget {
  const LanguagePickerScreen({super.key});

  @override
  State<LanguagePickerScreen> createState() => _LanguagePickerScreenState();
}

class _LanguagePickerScreenState extends State<LanguagePickerScreen> {
  final List<Map<String, String>> _languages = [
    {'code': 'tg', 'name': 'Тоҷикӣ', 'flag': '🇹🇯'},
    {'code': 'ru', 'name': 'Русский', 'flag': '🇷🇺'},
    {'code': 'en', 'name': 'English', 'flag': '🇬🇧'},
    {'code': 'uz', 'name': 'O\'zbek', 'flag': '🇺🇿'},
    {'code': 'kk', 'name': 'Қазақша', 'flag': '🇰🇿'},
    {'code': 'ky', 'name': 'Кыргызча', 'flag': '🇰🇬'},
    {'code': 'tk', 'name': 'Türkmen', 'flag': '🇹🇲'},
  ];

  @override
  Widget build(BuildContext context) {
    final currentLocale = context.locale.languageCode;

    return Scaffold(
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 24.0, vertical: 40.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              // Dynamic Branding Section
              const Icon(Icons.rocket_launch_rounded, size: 80, color: Color(0xFFFFC107)),
              const SizedBox(height: 16),
              Text(
                tr('appName'),
                style: const TextStyle(
                  fontSize: 28,
                  fontWeight: FontWeight.w900,
                  color: Colors.white,
                ),
                textAlign: TextAlign.center,
              ),
              const SizedBox(height: 8),
              Text(
                tr('appSlogan'),
                style: TextStyle(
                  fontSize: 16,
                  color: Colors.grey.shade400,
                ),
                textAlign: TextAlign.center,
              ),
              const SizedBox(height: 48),

              // Language List
              Expanded(
                child: ListView.builder(
                  itemCount: _languages.length,
                  itemBuilder: (context, index) {
                    final lang = _languages[index];
                    final isSelected = currentLocale == lang['code'];

                    return GestureDetector(
                      onTap: () {
                        context.setLocale(Locale(lang['code']!));
                      },
                      child: AnimatedContainer(
                        duration: const Duration(milliseconds: 300),
                        margin: const EdgeInsets.only(bottom: 12),
                        padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 16),
                        decoration: BoxDecoration(
                          color: isSelected ? const Color(0xFF2C2C2E) : const Color(0xFF1C1C1E),
                          borderRadius: BorderRadius.circular(16),
                          border: Border.all(
                            color: isSelected ? const Color(0xFFFFC107) : Colors.transparent,
                            width: 2,
                          ),
                          boxShadow: isSelected
                              ? [
                                  BoxShadow(
                                    color: const Color(0xFFFFC107).withOpacity(0.3),
                                    blurRadius: 10,
                                    offset: const Offset(0, 4),
                                  )
                                ]
                              : [],
                        ),
                        child: Row(
                          children: [
                            Text(lang['flag']!, style: const TextStyle(fontSize: 24)),
                            const SizedBox(width: 16),
                            Text(
                              lang['name']!,
                              style: TextStyle(
                                fontSize: 18,
                                fontWeight: isSelected ? FontWeight.bold : FontWeight.normal,
                                color: isSelected ? const Color(0xFFFFC107) : Colors.white,
                              ),
                            ),
                            const Spacer(),
                            if (isSelected)
                              const Icon(Icons.check_circle_rounded, color: Color(0xFFFFC107)),
                          ],
                        ),
                      ),
                    );
                  },
                ),
              ),

              // Continue Button
              ElevatedButton(
                onPressed: () {
                  context.go('/auth');
                },
                child: Text(tr('continue')),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
