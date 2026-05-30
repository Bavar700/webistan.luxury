import 'package:intl/intl.dart';

class DateUtilsHelper {
  DateUtilsHelper._();

  static final _dateFormat = DateFormat('dd.MM.yyyy');
  static final _timeFormat = DateFormat('HH:mm');
  static final _dateTimeFormat = DateFormat('dd.MM.yyyy HH:mm');
  static final _dayMonthFormat = DateFormat('dd MMMM');
  static final _weekdayFormat = DateFormat('EEEE');

  static String formatDate(DateTime date) => _dateFormat.format(date);

  static String formatTime(DateTime date) => _timeFormat.format(date);

  static String formatDateTime(DateTime date) => _dateTimeFormat.format(date);

  static String formatDayMonth(DateTime date) => _dayMonthFormat.format(date);

  static String formatWeekday(DateTime date) {
    final day = _weekdayFormat.format(date);
    return day[0].toUpperCase() + day.substring(1);
  }

  static String formatDuration(Duration duration) {
    final hours = duration.inHours;
    final minutes = duration.inMinutes.remainder(60);
    if (hours > 0) {
      return '${hours}ч ${minutes}мин';
    }
    return '${minutes}мин';
  }

  static bool isToday(DateTime date) {
    final now = DateTime.now();
    return date.year == now.year &&
        date.month == now.month &&
        date.day == now.day;
  }

  static bool isYesterday(DateTime date) {
    final yesterday = DateTime.now().subtract(const Duration(days: 1));
    return date.year == yesterday.year &&
        date.month == yesterday.month &&
        date.day == yesterday.day;
  }

  static bool isSameDay(DateTime a, DateTime b) {
    return a.year == b.year && a.month == b.month && a.day == b.day;
  }

  static bool isOverdue(DateTime deadline) {
    return deadline.isBefore(DateTime.now());
  }

  static String formatRelative(DateTime date) {
    if (isToday(date)) return 'Сегодня';
    if (isYesterday(date)) return 'Вчера';
    return formatDate(date);
  }

  static DateTime startOfDay(DateTime date) {
    return DateTime(date.year, date.month, date.day);
  }

  static DateTime endOfDay(DateTime date) {
    return DateTime(date.year, date.month, date.day, 23, 59, 59);
  }
}
