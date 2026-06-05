# 🏗️ Architectural Summary — For AI Assistants

> Этот документ создан для того, чтобы новый AI-ассистент мог быстро понять структуру, логику и архитектуру проекта без необходимости читать все файлы.

---

## 1. ОБЩИЙ ОБЗОР

**Название:** Офарин! Ту метавонӣ! (Молодец! Ты сможешь!)
**Тип:** Gamified Family Task Manager
**Платформы:** Web (Vanilla JS) + Mobile (Flutter)

---

## 2. ВЕБ-ВЕРСИЯ (`index.html` + `js/` + `css/`)

### 2.1 Файловая структура

```
js/translations.js    ← Система переводов (__(), __month(), __weekday())
js/data.js            ← Состояние, localStorage, логика экономики, тесты, достижения
js/app.js             ← UI-логика: навигация, рендеринг, модалки, таймер, события
css/style.css         ← Все стили (~1300 строк, CSS-переменные, анимации)
index.html            ← SPA с модалками (PIN, Timer, Confirm, Task, etc.)
```

### 2.2 Поток данных

```
localStorage (ключ: "kids_tasks_app")
    ↓ JSON.parse()
state = { pin, language, children[] }
    ↓
app.js читает state → рендерит UI
app.js изменяет state → saveState() → localStorage
```

**Пример структуры state:**
```js
{
  pin: "0000",
  language: "tg",
  children: [
    {
      id: "yusufkhuja",
      name: "Юсуфхӯҷа",
      emoji: "👦",
      rewardType: "money",  // "money" | "stars" | "both"
      balance: 0,
      stars: 0,
      tasks: [{ id, name, duration, emoji, order, deadline, isBonus, bonusPrice }],
      bonusTasks: [{...}],
      dailyLogs: {
        "2026-05-29": {
          tasks: { [taskId]: { status, confirmed, timeSpent, startedAt, photo, explanation } },
          excused: false,
          excuseReason: "",
          rewardApplied: false
        }
      },
      tenDayTests: [{ id, date, scores, totalScore, reward, starReward }],
      withdrawals: [{ date, amount }],
      achievements: []
    }
  ]
}
```

### 2.3 Ключевые функции в `data.js`

| Функция | Что делает |
|---------|-----------|
| `loadState()` | Загружает из localStorage или создаёт дефолт |
| `saveState()` | Сохраняет в localStorage |
| `getOrCreateDailyLog(childId)` | Создаёт/возвращает лог на сегодня |
| `calculateDailyReward(childId, date)` | Считает награду за день |
| `applyDailyReward(childId, date)` | Начисляет награду |
| `checkAndCreateTest(childId)` | Проверяет, пора ли 10-дневный тест |
| `evaluateTest(childId, testId, scores)` | Сохраняет результаты теста |
| `checkAchievements(childId)` | Проверяет и разблокирует достижения |
| `getRewardSymbol/formatBalanceAmount/formatBalanceFull` | Форматирование валют |

### 2.4 Ключевые функции в `app.js`

**Навигация:**
- `navigateTo(page)` — переключение между dashboard/calendar/balance/settings/parent
- `renderChildTabs()` — селектор детей в шапке

**Задачи:**
- `renderTasks()` — рендеринг задач на сегодня
- `createTaskCard(task, tl, log, child, isBonus)` — создаёт карточку задачи
- `showConfirmModal(task)` — подтверждение выполнения (PIN)
- `showTimer(childId, task)` — запуск таймера
- `submitProof()` — отправка фото/описания

**Календарь:**
- `renderCalendar()` — рендеринг месяца
- `showDayDetails(dateStr)` — детали дня

**Экономика:**
- `renderBalance()` — страница баланса
- `showWithdrawModal()` / `submitWithdraw()` — снятие денег
- `showTestModal(test)` / `submitTest()` — 10-дневный тест

**Родительская панель:**
- `renderParentDashboard()` — управление задачами (добавление/удаление/редактирование)

**Модалки:**
- PIN-модалка (`#pin-modal`)
- Подтверждение задачи (`#confirm-modal`) — с фото ребёнка
- Таймер (`#timer-modal`) — с фото-подтверждением
- Excuse day (`#excuse-modal`)
- Withdrawal (`#withdraw-modal`)
- Test (`#test-modal`)
- Add/Edit task (`#task-modal`)
- Add/Edit child (`#child-modal`)

### 2.5 Система переводов

```js
// В translations.js:
const TRANSLATIONS = { tg: { ... }, ru: { ... } };

function __(key, params)     // получить перевод по ключу
function __month(index)      // название месяца
function __weekday(index)    // день недели
```

---

## 3. FLUTTER-ВЕРСИЯ (`ofarin_app/`)

### 3.1 Архитектура (Clean Architecture)

```
ofarin_app/lib/
├── main.dart                    ← Точка входа (runApp)
├── app.dart                     ← App (MaterialApp.router, тема, локализация)
├── core/                        ← Общие компоненты
│   ├── constants/               ← API и App константы
│   ├── errors/                  ← Exceptions & Failures
│   ├── network/                 ← ApiClient (Supabase wrapper)
│   ├── router/                  ← GoRouter
│   ├── theme/                   ← Тема (цвета, стили)
│   ├── utils/                   ← Formatters, validators
│   └── widgets/                 ← Shimmer loading
├── features/                    ← Фичи (каждая со своей архитектурой)
│   ├── auth/                    ← Авторизация + PIN
│   ├── family/                  ← Дети + статистика
│   ├── onboarding/              ← Онбординг (выбор языка)
│   ├── settings/                ← Настройки, тема
│   ├── tasks/                   ← Задания (CRUD, таймер, статусы)
│   ├── wallet/                  ← Кошелёк, баланс, транзакции
│   └── wishlist/                ← Список желаний
```

### 3.2 Каждая фича внутри делится на:

```
features/tasks/
├── data/
│   ├── enums/                   ← TaskStatus, TaskType
│   ├── models/                  ← TaskModel, TaskInstanceModel (fromJson/toJson)
│   └── repositories/            ← TaskRepository (impl)
├── domain/
│   ├── entities/                ← Task, TaskInstance (чистые Dart-классы)
│   └── repositories/            ← Abstract repository interfaces
└── presentation/
    ├── providers/               ← Riverpod providers (StateNotifier)
    ├── screens/                 ← UI экраны
    └── widgets/                 ← Переиспользуемые виджеты
```

### 3.3 Технологии

| Компонент | Технология |
|-----------|-----------|
| State Management | Riverpod + riverpod_annotation |
| Navigation | GoRouter |
| Backend | Supabase (supabase_flutter) |
| Auth | Supabase Auth + flutter_secure_storage |
| Localization | easy_localization (7 языков) |
| Animations | Lottie, Confetti |
| UI | Material 3, Google Fonts, ScreenUtil |
| Code generation | build_runner + freezed + json_serializable |
| Storage | shared_preferences |

### 3.4 База данных (Supabase PostgreSQL)

**Схема:** `ofarin_app/supabase/migrations/001_initial_schema.sql`

**Таблицы:**
- `profiles` — пользователи (id, family_id, role, name, avatar_url, preferred_language)
- `tasks` — задания (id, child_id, parent_id, title, is_bonus, timer_duration_mins, deadline_at, reward_amount, reward_currency, penalty_amount, proof_image_url, status)
- `wallets` — кошельки (child_id, balance_fiat, balance_stars, balance_gold)
- `wishlist` — желания (child_id, title, price_fiat, price_stars, price_stars, status)

**RLS:** Row-Level Security включена для всех таблиц.

**Функции:**
- `handle_new_user()` — триггер при регистрации
- `get_wallet(p_child_id)` — получить баланс
- `get_task_summary(p_child_id)` — статистика задач
- `fulfill_wishlist(p_wishlist_id, p_parent_uuid)` — покупка желания

---

## 4. ЭКОНОМИКА (общая для обеих версий)

### 4.1 Типы валют

- **Сомони (fiat)** — реальные деньги для старших детей
- **Звёзды (stars)** — виртуальная валюта для младших
- **Gold** — премиум-валюта (только в Flutter)

### 4.2 Награды

| Действие | Награда |
|----------|---------|
| Все задания выполнены | +1 единица (+ бонусные) |
| Не выполнено | -1 единица |
| 10-дневный тест (10/10) | +2 единицы |
| 10-дневный тест (9/10) | +1 единица |
| Бонусное задание 3 смн | +3 единицы |
| Бонусное задание 5 смн | +5 единиц |
| Бонусное задание 10 смн | +10 единиц |

### 4.3 Достижения

11 достижений: first_task, all_today, week_streak (7 дней), month_streak (30 дней), test_10, test_9, bonus_3/5/10, savings_10/50.

---

## 5. ОСОБЕННОСТИ ДЛЯ РАЗРАБОТЧИКА

### 5.1 Веб-версия

- **Нет сборщика** — работает из коробки (просто открой `index.html`)
- **Все стили** в `css/style.css` (CSS-переменные в `:root`)
- **Все переводы** в `translations.js`
- **Данные** только в localStorage — нет бэкенда

### 5.2 Flutter-версия

- Использует **riverpod_generator** — нужен `build_runner`
- **Секреты** в `.env` файле (не в git)
- **Миграции БД** применяются через Supabase Dashboard
- **Тесты** в `test/` (требуют Flutter SDK)

---

## 6. ЧТО ВАЖНО ЗНАТЬ НОВОМУ AI

1. **Не путать две версии** — веб-прототип (`index.html`) и Flutter (`ofarin_app/`) — это разные реализации одного приложения
2. **Веб-версия не имеет бэкенда** — все данные в localStorage
3. **Flutter-версия требует Supabase** — без ключей не запустится
4. **Clean Architecture** в Flutter — соблюдай разделение на data/domain/presentation
5. **Riverpod** — провайдеры в `features/*/presentation/providers/`
6. **localStorage ключ:** `"kids_tasks_app"` (важно для отладки)
7. При изменении `state` в веб-версии всегда вызывай `saveState()`
8. При переводе строк используй `__('key')` — все ключи в `translations.js`

---

*Документ создан: 29 мая 2026*
*Для передачи между AI-ассистентами*
