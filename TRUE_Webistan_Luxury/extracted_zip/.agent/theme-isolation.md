# Theme Isolation Protocol (Zero-Drift)

This document enforces strict separation between Light and Dark themes for the Webistan Luxury project.
Every developer (human or AI) MUST adhere to these rules without exception.

---

## 1. BRAND CONSTANTS — ALWAYS DARK (#0A0A0B)

The following components are **brand-locked to dark** and must NEVER use `bg-background` or any theme variable.
They must always use the **hardcoded value `bg-[#0A0A0B]` and `text-white`**:

| Component | File |
|---|---|
| Navbar (top bar + mobile overlay) | `src/components/layout/Navbar.tsx` |
| Hero Section | `src/components/layout/HeroSection.tsx` |
| Promo Banner (inside Calculator) | `src/components/forms/ProjectCalculator.tsx` |

**Rule:** If you see `bg-background` in any of these files — it is a bug. Replace it immediately with `bg-[#0A0A0B]`.

---

## 2. THEME-AWARE COMPONENTS — Use Variables Only

All other components must use CSS variables:

- ✅ `bg-background` → resolves to `#0A0A0B` (dark) or `#F2F4F7` (light)
- ✅ `style={{ color: 'var(--calc-title-color)' }}`
- ✅ `bg-surface`, `text-foreground`, `border-accent/10`
- ❌ NEVER `bg-[#F2F4F7]` or `text-[#0A0A0B]` in JSX — use variables

---

## 3. globals.css — Strict Selector Discipline

When adding or modifying variables:

- **Dark theme changes** → only inside `:root { }` block
- **Light theme changes** → only inside `[data-theme='light'] { }` block
- Never touch `:root` when working on light theme
- Never touch `[data-theme='light']` when working on dark theme

Example:
```css
/* ✅ CORRECT */
:root {
  --btn-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);  /* dark only */
}
[data-theme='light'] {
  --btn-shadow: none;  /* light only */
}

/* ❌ WRONG — modifying :root while working on light theme */
:root {
  --btn-shadow: none;
}
```

---

## 4. Verification Checklist (Before Every Commit)

1. Switch to **Dark Mode** → Hero and Navbar must be `#0A0A0B`. No gray/white leak.
2. Switch to **Light Mode** → Content sections must be `#F2F4F7`. No shadows on buttons.
3. Hero Section must be dark in **both** modes.
4. No `style={{ backgroundColor: '#F2F4F7' }}` in JSX — only CSS variables.

---

## 5. ThemeProvider Default

`ThemeProvider.tsx` default state must be `'light'` and fallback `data-theme='light'`.
The dark theme is accessed only via user toggle.
