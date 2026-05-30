# ⭐ Офарин! Ту метавонӣ! — Gamified Family Task Manager

> **"Well done! You can do it!"** — A mobile app for children's task management, time management, and financial literacy.

## 📱 Overview

Built with **Flutter** (iOS/Android) and **Supabase** (PostgreSQL + Auth), this app helps parents:
- Create and assign tasks with rewards and penalties
- Track daily routines, timed sessions, and bonus tasks
- Manage a dual economy system (Stars for young kids, Local currency for older kids)
- Approve/reject completed tasks and manage wishlist payouts

Children can:
- View their daily tasks with fun animations
- Start timers for timed assignments (locks-in focus mode)
- Earn stars/currency and build streaks
- Save up for Wishlist items and request payouts

## 🏗️ Architecture

```
ofarin_app/
├── lib/
│   ├── main.dart                    # Entry point
│   ├── app.dart                     # App widget with router & theme
│   ├── core/                        # Shared utilities & foundations
│   │   ├── constants/               # App & API constants
│   │   ├── errors/                  # Exceptions & Failures
│   │   ├── network/                 # API client (Supabase wrapper)
│   │   ├── theme/                   # Light/Dark theme & colors
│   │   └── utils/                   # Validators, formatters
│   ├── data/                        # Data layer
│   │   ├── models/                  # JSON serializable models
│   │   ├── repositories/            # Data repositories
│   │   ├── datasources/             # Remote (Supabase) & Local sources
│   │   └── enums/                   # Shared enums
│   ├── domain/                      # Domain layer (Clean Architecture)
│   │   ├── entities/                # Pure Dart entities
│   │   ├── usecases/                # Business logic use cases
│   │   └── repositories/            # Abstract repository interfaces
│   └── presentation/                # UI layer (Riverpod + GoRouter)
│       ├── providers/               # State management
│       ├── router/                  # Navigation
│       ├── common_widgets/          # Reusable widgets
│       └── screens/                 # Screen pages
│           ├── auth/                # Login, PIN
│           ├── parent/              # Parent dashboard & management
│           └── child/               # Child dashboard & activities
├── supabase/                        # Backend schema & config
│   └── migrations/                  # SQL migrations
├── assets/                          # Images, fonts, animations
└── test/                            # Tests
```

## 🗄️ Database Schema

### Core Tables

| Table | Purpose |
|-------|---------|
| `profiles` | User profiles (parents & children) with roles, balance, PIN |
| `tasks` | Task templates created by parents |
| `task_instances` | Daily task instances with status tracking |
| `transactions` | Economy ledger (rewards, penalties, payouts) |
| `wishlist_items` | Child's wishlist with prices |
| `achievements` | Unlocked achievements |
| `streaks` | Daily streak tracking |

Full schema: `supabase/migrations/001_initial_schema.sql`

### Row-Level Security
- **RLS enabled** on all tables
- Parents have full CRUD on their children's data
- Children have read/update access to their own data only

## 🚀 Getting Started

### Prerequisites

1. **Flutter SDK** (≥3.44.0) — [Download](https://docs.flutter.dev/install/archive)
2. **Supabase account** — [supabase.com](https://supabase.com)

### Setup

```bash
# Clone the project
cd ofarin_app

# Install dependencies
flutter pub get

# Copy environment file
cp .env.example .env
# Edit .env with your Supabase credentials

# Run on device
flutter run
```

### Database Setup

1. Create a new Supabase project
2. Run the migration: `supabase/migrations/001_initial_schema.sql`
3. Copy your Supabase URL and anon key to `.env`

## 🎮 Features

- **Dual Mode**: Parent mode (PIN-protected) + Child mode
- **4 Task Types**: Daily routines, Deadlines, Bonus tasks, Timed sessions
- **Economy**: Stars (kids) / Local currency (teens) — or both!
- **Penalty System**: -currency for missed mandatory tasks
- **Wishlist**: Children save up and request purchases
- **Streaks**: Daily completion tracking with milestones
- **Achievements**: Gamified rewards for consistency
- **i18n**: Tajik, Kazakh, Uzbek, Russian, Kyrgyz, English, Turkmen

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| **Frontend** | Flutter 3.44+ (Dart 3.7) |
| **State Management** | Riverpod |
| **Navigation** | GoRouter |
| **Backend** | Supabase (PostgreSQL + Auth) |
| **Auth** | Supabase Auth + PIN hashing |
| **Animations** | Lottie, Confetti Widget |
| **UI** | Material 3, Google Fonts, ScreenUtil |

## 🌍 Localization

The app is designed for multi-language support:
- 🇹🇯 Tajik (tg)
- 🇰🇿 Kazakh (kk)  
- 🇺🇿 Uzbek (uz)
- 🇷🇺 Russian (ru)
- 🇰🇬 Kyrgyz (ky)
- 🇬🇧 English (en)
- 🇹🇲 Turkmen (tk)
