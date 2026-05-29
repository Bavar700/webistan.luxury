# ⭐ Офарин! Ту метавонӣ! / Молодец! Ты сможешь!

**Gamified Family Task Manager** — приложение для управления детскими заданиями с геймификацией, экономикой и отслеживанием прогресса.

---

## 📦 Что здесь есть

В этом репозитории находятся **два проекта**:

### 1️⃣ Веб-прототип (Vanilla JS) — `./`

| Файл | Назначение |
|------|-----------|
| `index.html` | Вся разметка (SPA с модалками, таймером, календарём) |
| `css/style.css` | Полный дизайн (тёмная тема, анимации, Material-стиль) |
| `js/translations.js` | Система переводов (таджикский 🇹🇯 + русский 🇷🇺) |
| `js/data.js` | Управление данными, localStorage, достижения, тесты |
| `js/app.js` | Вся логика: навигация, таймер, задачи, модалки |

**Данные:** `localStorage` браузера (ключ: `kids_tasks_app`)

**Фичи:**
- Ежедневные задания с таймером
- Бонусные задания
- Система поощрений (деньги / звёзды)
- Календарь выполнения
- 10-дневные тесты
- Достижения
- Родительский PIN-доступ
- Режим "Уважительная причина"
- Фото-подтверждение выполнения

### 2️⃣ Flutter-приложение (Mobile) — `./ofarin_app/`

| Файл | Назначение |
|------|-----------|
| `lib/main.dart` | Точка входа |
| `lib/app.dart` | App widget с роутером и темой |
| `lib/core/` | Константы, тема, утилиты, сетевой клиент |
| `lib/features/` | Модули: auth, tasks, wallet, wishlist, family, settings |
| `supabase/migrations/001_initial_schema.sql` | Полная схема БД |
| `assets/translations/` | 7 языков (tg, kk, ky, ru, tj, tk, uz) |
| `pubspec.yaml` | Зависимости Flutter |

**Бэкенд:** Supabase (PostgreSQL + Auth + Storage)

---

## 🏗️ Архитектура (коротко)

```
├── index.html + js/ + css/    ← Веб-прототип (Vanilla JS)
├── ofarin_app/                 ← Flutter приложение (Mobile)
│   ├── lib/
│   │   ├── core/               ← Фундамент (константы, тема, сеть)
│   │   ├── features/           ← Фичи (Clean Architecture)
│   │   │   ├── auth/           ← Авторизация + PIN
│   │   │   ├── tasks/          ← Задания (CRUD + таймер)
│   │   │   ├── wallet/         ← Кошелёк (3 валюты)
│   │   │   ├── wishlist/       ← Список желаний
│   │   │   ├── family/         ← Семья (дети + статистика)
│   │   │   ├── settings/       ← Настройки
│   │   │   └── onboarding/     ← Онбординг
│   │   └── main.dart
│   ├── supabase/migrations/    ← Схема БД (PostgreSQL)
│   └── pubspec.yaml
```

---

## 🗄️ База данных (Supabase / PostgreSQL)

Файл: `ofarin_app/supabase/migrations/001_initial_schema.sql`

**Таблицы:**
| Таблица | Назначение |
|---------|-----------|
| `profiles` | Пользователи (роли: parent/child) |
| `tasks` | Задания (с таймером, дедлайном, ценой) |
| `wallets` | Кошельки (3 валюты: fiat, stars, gold) |
| `wishlist` | Список желаний детей |

**RLS (Row-Level Security):** включена на всех таблицах

**Триггеры:**
- `handle_new_user()` — автосоздание профиля и кошелька при регистрации
- `fulfill_wishlist()` — покупка желания (списание со всех валют)

---

## 🔐 Secrets & Environment (⚠️ КРИТИЧЕСКИ ВАЖНО)

**Файл:** `ofarin_app/.env`

```
SUPABASE_URL=https://your-project.supabase.co
SUPABASE_ANON_KEY=your-anon-key-here
```

> **⚠️⚠️⚠️ ВАЖНО!** Файл `.env` с реальными ключами Supabase **уже существует** на компьютере, но он **не включён в git** (в `.gitignore`).
> 
> **Без него Flutter-приложение НЕ ЗАПУСТИТСЯ.**
>
> При передаче другому AI обязательно нужно:
> 1. Отдельно скопировать `ofarin_app/.env` (реальный файл с ключами)
> 2. Или экспортировать ключи из Supabase Dashboard: Project Settings → API
>
> **Примерный файл** с подсказками: `ofarin_app/.env.example`

---

## 🚀 Быстрый старт для нового AI

1. **Прочитать этот README** — чтобы понять, что за проект
2. **Прочитать `architectural-summary.md`** — чтобы быстро въехать в код
3. **Для веб-версии:** открыть `index.html` в браузере (работает из коробки)
4. **Для Flutter:**
   ```bash
   cd ofarin_app
   flutter pub get
   # Настроить .env с ключами Supabase
   flutter run
   ```

---

## 🌐 Локализация

- Веб-версия: 2 языка (таджикский 🇹🇯, русский 🇷🇺)
- Flutter: 7 языков (tg, kk, ky, ru, tj, tk, uz)

Файлы переводов:
- Веб: `js/translations.js`
- Flutter: `ofarin_app/assets/translations/*.json`

---

## 🤖 Для нового AI-ассистента

Этот проект использует:
- **Vanilla JS** (без фреймворков) — вся логика в одном файле `app.js`
- **Flutter 3.7+** с Riverpod (state management) и GoRouter (navigation)
- **Supabase** (PostgreSQL + Auth + RLS)
- **Clean Architecture** в Flutter-части
- **localStorage** для веб-прототипа

При работе с проектом:
1. Сначала прочитай `architectural-summary.md` — там полный обзор кода
2. Для изменений в веб-версии редактируй `js/app.js` и `js/data.js`
3. Для Flutter соблюдай Clean Architecture (data → domain → presentation)
4. Сохраняй структуру папок и нейминг
