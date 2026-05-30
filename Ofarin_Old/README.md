# Офарин! Ту метавонӣ! (Well done! You can do it!)

A gamified family app designed for task management, time management, and financial literacy for children. Supports a dual economy system (Stars and Local Currency), parent authorization via PIN, and locked task timers.

---

## 🚀 Tech Stack
- **Frontend**: Flutter (Riverpod state management, GoRouter navigation, Material 3 design)
- **Backend & Database**: Supabase (PostgreSQL for reliable transactions, Supabase Auth)
- **Localization (i18n)**: Supports English, Tajik (default), Russian, Uzbek, Kazakh, Kyrgyz, and Turkmen.

---

## 📂 Folder Structure

The project uses a **Feature-first / Clean Architecture** approach to isolate business domains and make development highly modular and scalable:

```
Ofarin/
├── database/
│   └── schema.sql            # PostgreSQL schema script (Supabase setup)
├── lib/
│   ├── main.dart             # App entry point & initialization
│   ├── app.dart              # MaterialApp setup (routing, theme, localization)
│   ├── constants/            # Global UI styling constants
│   │   ├── app_colors.dart   # Sleek palettes & premium gradients
│   │   ├── app_theme.dart    # M3 Light/Dark setups
│   │   └── app_sizes.dart    # Consistent spacing tokens
│   ├── l10n/                 # Multi-language Application Resource Bundles (.arb)
│   ├── routing/              # GoRouter configuration
│   └── features/             # App Business Domains
│       ├── auth/             # Login, PIN protection, mode selection
│       ├── tasks/            # Daily routines, deadlines, timers, and approval system
│       ├── economy/          # Stars/fiat wallet, payout ledgers
│       ├── wishlist/         # Child wishlist and parent approval workflows
│       └── profile/          # Family profiles management
└── pubspec.yaml              # Dependencies and project config
```

---

## 🗄️ Database Setup (Supabase / PostgreSQL)

1. Open your **Supabase Dashboard**.
2. Navigate to the **SQL Editor** tab.
3. Paste the contents of [schema.sql](database/schema.sql) and click **Run**.
4. This will set up the:
   - `profiles` table (linked to `auth.users`)
   - `tasks` table (with routine/deadline types)
   - `wishlist_items` table
   - `transactions` table (ledger log)
   - Automatic triggers to create profiles on new sign-ups.

---

## 🛠️ Flutter Development Setup

### Dependencies Installation
Since we have configured `pubspec.yaml`, you can install dependencies by running:
```bash
flutter pub get
```

### Running the App
To run the project on an emulator/device:
```bash
flutter run
```

### Generating Code (Riverpod Generators)
If code generator annotations are added for state management:
```bash
flutter pub run build_runner build --delete-conflicting-outputs
```

---

## 🌐 Localization (i18n)

To add new translations or edit existing labels, modify the files in the `lib/l10n/` directory:
- `app_tg.arb` (Tajik - Default)
- `app_en.arb` (English)
- `app_ru.arb` (Russian)
- `app_uz.arb` (Uzbek)
- `app_kk.arb` (Kazakh)
- `app_ky.arb` (Kyrgyz)
- `app_tk.arb` (Turkmen)
