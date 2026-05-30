/// Системаи сатҳҳо ва XP барои Ofarin 🎮
/// RPG-style level system with Tajik titles and badges

class XpLevelSystem {
  XpLevelSystem._(); // Конструктори хусусӣ — танҳо методҳои статикӣ

  /// Формула: XP барои сатҳи N = 50 * N * (N - 1)
  /// L1=0, L2=100, L3=300, L4=600, L5=1000, ... L10=4500, L20=19000, L50=122500
  static int getXpForLevel(int level) {
    if (level <= 1) return 0;
    return 50 * level * (level - 1);
  }

  /// Сатҳи ҷорӣ аз рӯи XP 📊
  static int getLevelForXp(int xp) {
    if (xp <= 0) return 1;
    int level = 1;
    while (getXpForLevel(level + 1) <= xp) {
      level++;
    }
    return level;
  }

  /// Пешрафт ба сатҳи навбатӣ (0.0 то 1.0) 📈
  static double getProgressToNextLevel(int xp) {
    final currentLevel = getLevelForXp(xp);
    final currentLevelXp = getXpForLevel(currentLevel);
    final nextLevelXp = getXpForLevel(currentLevel + 1);
    final totalNeeded = nextLevelXp - currentLevelXp;

    if (totalNeeded <= 0) return 1.0;

    final progress = (xp - currentLevelXp) / totalNeeded;
    return progress.clamp(0.0, 1.0);
  }

  /// XP-и боқимонда то сатҳи навбатӣ 🎯
  static int getXpToNextLevel(int xp) {
    final currentLevel = getLevelForXp(xp);
    final nextLevelXp = getXpForLevel(currentLevel + 1);
    return nextLevelXp - xp;
  }

  /// Унвони сатҳ бо забони тоҷикӣ 🇹🇯
  /// 1-5: Навомӯз (Beginner)
  /// 6-10: Шогирд (Student)
  /// 11-15: Донишҷӯ (Scholar)
  /// 16-20: Устод (Master)
  /// 21-30: Қаҳрамон (Hero)
  /// 31-40: Афсона (Legend)
  /// 41-50: Подшоҳ (King)
  static String getLevelTitle(int level) {
    if (level <= 5) return 'Навомӯз';
    if (level <= 10) return 'Шогирд';
    if (level <= 15) return 'Донишҷӯ';
    if (level <= 20) return 'Устод';
    if (level <= 30) return 'Қаҳрамон';
    if (level <= 40) return 'Афсона';
    return 'Подшоҳ';
  }

  /// Нишони сатҳ (эмоҷӣ) 🏅
  /// 1-5: 🌱, 6-10: ⭐, 11-15: 💫, 16-20: 🔥, 21-30: ⚔️, 31-40: 👑, 41-50: 🏆
  static String getLevelBadge(int level) {
    if (level <= 5) return '🌱';
    if (level <= 10) return '⭐';
    if (level <= 15) return '💫';
    if (level <= 20) return '🔥';
    if (level <= 30) return '⚔️';
    if (level <= 40) return '👑';
    return '🏆';
  }

  /// Аватарҳои дастрас барои интихоб 🎭
  static List<String> get availableAvatars => const [
        '🦁',
        '🐉',
        '🦊',
        '🐺',
        '🦄',
        '🐼',
        '🦅',
        '🐯',
        '🐻',
        '🦇',
        '🐲',
        '🦋',
      ];

  /// Маълумоти пурра дар бораи сатҳ 📋
  static Map<String, dynamic> getLevelInfo(int xp) {
    final level = getLevelForXp(xp);
    return {
      'level': level,
      'title': getLevelTitle(level),
      'badge': getLevelBadge(level),
      'progress': getProgressToNextLevel(xp),
      'xp_to_next': getXpToNextLevel(xp),
      'current_xp': xp,
      'level_xp_threshold': getXpForLevel(level),
      'next_level_xp_threshold': getXpForLevel(level + 1),
    };
  }
}
