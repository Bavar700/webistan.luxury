# Neksoz Trilingual Routing Rules (Ironclad System)

This document contains mandatory rules for the Neksoz WordPress theme. **DO NOT CHANGE THESE RULES** without explicit user permission. These rules prevent language drift and ensure consistent routing.

## 1. The Language Source of Truth
- The current language is derived **ONLY** from the `?lang=` query parameter.
- The `nk_get_current_lang()` function in `functions.php` is the single source of truth.
- Default language is `ru` if the parameter is missing.

## 2. Page Routing Logic (Top-Level)
- Every primary page template (e.g., `page-team.php`, `page-services.php`, `service-audit.php`) **MUST** start with the language routing block:
  ```php
  if (function_exists('nk_get_current_lang')) {
      $lang = nk_get_current_lang();
      if ($lang === 'tj') { get_template_part('page-slug', 'tj'); return; }
      if ($lang === 'en') { get_template_part('page-slug', 'en'); return; }
  }
  ```
- This prevents the default (RU) template from rendering when a specific language is requested.

## 3. Link Generation (nk_link)
- **NEVER** use `home_url()` directly for internal links.
- **ALWAYS** wrap internal links in `nk_link($path, $lang)`.
- The `nk_link` function automatically:
    - Strips existing `-tj` or `-en` suffixes.
    - Strips existing `?lang=` parameters.
    - Appends the correct suffix and `?lang=` parameter based on the requested language.

## 4. Header & Footer Link Parity
- The header and footer MUST use the dynamic `$current_lang` variable.
- Switching languages MUST only happen via the dedicated `lang-switcher` in the header, which uses `nk_get_switcher_link()`.

## 5. File Naming Convention
- Russian (Primary): `page-slug.php`
- Tajik: `page-slug-tj.php`
- English: `page-slug-en.php`
- Shared/Partials: `template-parts/...`

## 6. Protection Against Overwrites
- If a mass-replacement script is used, it **MUST NOT** strip the `$current_lang` variable or replace it with hardcoded strings.
- All code changes must be verified against the `?lang=en` and `?lang=tj` parameters on local development.

---
**Status:** ACTIVE
**Last Updated:** 2026-04-22
