# Voxel popups overview (`ts-field-popup-container`)

This document maps where popups (identified by class `ts-field-popup-container`) are used and where their templates live.

---

## Rework summary (accessibility & clean code)

- **Single template:** All popups (including static `.ts-popup-component`) now use the same `#voxel-popup-template`. Static popups pass `:show-controller="false"` and use the **footer** slot.
- **Accessibility:** Popup panel has `role="dialog"`, `aria-modal`, optional `aria-label` / `aria-labelledby`, and close button `aria-label`. **Escape** closes the popup; focus is restored to the trigger on close.
- **Blurable mixin:** One clear outside-click handler; “inside” = `.triggers-blur` panel only (backdrop clicks close). Optional `_restoreFocus()` is called after blur.
- **Popup component:** New props: `showController`, `popupLabel`, `popupLabelledBy`, `ariaModal`, `closeButtonLabel`, `triggerOnHoverClose`. `close()` method centralizes blur + focus restore. Escape key handled in component.
- **BEM markup:** Root is `.vx-popup__panel` (no outer wrapper). Content `.vx-popup__content`, actions `.vx-popup__actions`. Reusable modifiers: `.vx-popup__panel--centered` (fixed, viewport center), `.vx-popup__panel--backdrop` (visible backdrop).

---

## 1. Core popup system

### 1.1 Vue popup template (main component)

| Item | Location |
|------|----------|
| **HTML template** | `templates/components/popup.php` |
| **Template ID** | `#voxel-popup-template` |
| **JS component** | `assets/scripts/frontend/commons/_popup-component.js` → `Voxel.components.popup` |
| **Registered as** | `form-popup` (and sometimes `popup`) in various app entry points |

**Loaded in:**
- `header.php` (site frontend)
- Elementor editor canvas: `app/modules/elementor/controllers/elementor-controller.php` → `print_required_templates_in_canvas()` (also loads `form-group.php`)

**Markup:** Contains `.ts-field-popup-container` > `.ts-field-popup.triggers-blur` with `ts-popup-content-wrapper`, optional `ts-popup-controller` (Save/Clear/Close).

---

### 1.2 Static popup (inline form-popup for `.ts-popup-component`)

| Item | Location |
|------|----------|
| **JS** | `assets/scripts/frontend/commons/_static-popup.js` |
| **Imported by** | `assets/scripts/frontend/commons/commons.js` (alongside `_popup-component`) |

Renders popups for elements with class `ts-popup-component`. Uses the same `Voxel.components.popup` and `#voxel-popup-template`; passes `:show-controller="false"` and `:trigger-on-hover-close` for hover-to-close. Supports hover trigger via `ts-trigger-on-hover`.

---

## 2. Templates that render `ts-field-popup-container`

| Template | Purpose | Notes |
|----------|---------|------|
| `templates/components/popup.php` | Vue popup wrapper | Single shared template for all Vue-driven popups (Save/Clear/Close). |
| `templates/widgets/search-form.php` | Search filters portal | One container in the teleported search portal (filter panel). |
| `templates/widgets/popup-kit.php` | Popup style kit (design only) | Static preview of popup variants for **Design > General > Style kits > Popup styles**. Many `.ts-field-popup-container` blocks (head, switcher, stepper, range, empty state, notifications, term dropdowns, etc.). |
| Inline in JS | Static form-popup | `_static-popup.js` builds the same container structure for `ts-popup-component` instances. |

---

## 3. Widgets that use these popups

### 3.1 Widgets with popup **templates** (markup)

| Widget | Main template | Popup usage |
|--------|----------------|-------------|
| **Search form** | `templates/widgets/search-form.php` | One `.ts-field-popup-container` in the search portal; filter chips use `ts-popup-target` and open this panel. |
| **Popup kit** | `templates/widgets/popup-kit.php` | Static style preview only; 9+ container examples (head, content, controller, dropdowns, empty state, etc.). |
| **User bar** | `templates/widgets/user-bar.php` | Wraps items in `ts-popup-component`; actual popup content in sub-templates. |
| **User bar – Cart** | `templates/widgets/user-bar/cart.php` | `<form-popup>` (uses Vue popup template). |
| **User bar – Messages** | `templates/widgets/user-bar/messages.php` | `<form-popup>`. |
| **User bar – Notifications** | `templates/widgets/user-bar/notifications.php` | `<form-popup>`. |
| **Create post** | Various in `templates/widgets/create-post/` | Uses `form-popup` and `form-group` (which uses popup); media popup in `_media-popup.php`. |
| **Create post – Media popup** | `templates/widgets/create-post/_media-popup.php` | `<form-popup>` for media library; included by create-post, messages widget, timeline status-composer, comment-composer. |
| **Form group** | `templates/components/form-group.php` | Wraps field in `<form-popup>` (reused by search form filters, create post, etc.). |
| **Timeline** | `templates/widgets/timeline/` | Status repost: `status/status.php` (`form-popup`). Dropdown: `partials/_dropdown-list.php`. Emoji: `partials/_emoji-picker.php`. |
| **Product form – Addons** | `templates/widgets/product-form/form-addons.php` | `<form-popup>`. |
| **Advanced list – Share** | `templates/widgets/advanced-list/share-post-action.php` | `<popup>` (same component, different tag). |
| **Collections** | `app/modules/collections/templates/frontend/save-to-collection-action.php` | Uses `form-popup` transition. |
| **Advanced list – Edit** | `templates/widgets/advanced-list/edit-post-action.php` | Wrapper has class `ts-popup-component`. |

### 3.2 Widgets that only style popups (no template change)

These register Elementor controls for `.ts-field-popup-container` / `.ts-field-popup` (e.g. margin, min/max width) but do not define the popup markup themselves; they use the shared template or a parent widget’s portal.

| Widget (app) | File | Role |
|--------------|------|------|
| Search form | `app/widgets/search-form.php` | Popup styling controls. |
| Create post | `app/widgets/create-post.php` | Popup styling controls. |
| Quick search | `app/widgets/quick-search.php` | Popup styling controls. |
| Navbar | `app/widgets/navbar.php` | Popup styling controls. |
| User bar | `app/widgets/user-bar.php` | Popup styling controls. |
| Booking calendar | `app/widgets/booking-calendar.php` | Popup styling controls. |
| Popup kit | `app/widgets/popup-kit.php` | Global popup styles (Design > Style kits > Popup styles). |

---

## 4. Navigation / menu

| File | Usage |
|------|--------|
| `app/utils/nav-menu-walker.php` | Adds `ts-popup-component` and `ts-trigger-on-hover` to nav items; `ts-popup-component ts-mobile-menu` for mobile. Popup content is rendered by static popup when these elements exist. |

---

## 5. Styles

| File | Role |
|------|------|
| `assets/styles/frontend/popup-kit.scss` | Base styles for `.ts-field-popup-container`, `.ts-field-popup`, and nested pieces (`.ts-popup-controller`, `.uib`, form elements, etc.). |

---

## 6. Elementor option groups (popup styling)

Shared styling for popup parts; used by Popup kit and other widgets that show popup controls:

| Option group | File | Targets |
|--------------|------|---------|
| Popup general | `app/widgets/option-groups/popup-general.php` | `.ts-field-popup`, `.ts-field-popup-container` (margin), background, border-radius, scroll, borders. |
| Popup controller | `app/widgets/option-groups/popup-controller.php` | `.ts-field-popup .ts-btn`. |
| Popup menu | `app/widgets/option-groups/popup-menu.php` | `.ts-field-popup .ts-term-dropdown` (padding, height, typography, hover, selected). |
| Popup radio | `app/widgets/option-groups/popup-radio.php` | `.ts-field-popup .container-radio .checkmark`. |
| Popup label | `app/widgets/option-groups/popup-label.php` | `.ts-field-popup .ts-form-group label/small`. |
| Popup input | `app/widgets/option-groups/popup-input.php` | `.ts-field-popup input`, `.ts-field-popup .ts-input-icon`. |
| Popup icon button | `app/widgets/option-groups/popup-icon-button.php` | `.ts-field-popup .ts-icon-btn`. |

---

## 7. Scripts that register `form-popup`

The same Vue popup component is registered as `form-popup` (and sometimes `popup`) in:

- `assets/scripts/frontend/commons/_static-popup.js` (inline form-popup for `ts-popup-component`)
- `assets/scripts/frontend/commons/_form-group-component.js` (uses `Voxel.components.popup`)
- `assets/scripts/frontend/create-post/create-post.js`
- `assets/scripts/frontend/timeline/timeline-main/timeline-main.js`
- `assets/scripts/frontend/messages/messages.js`
- `assets/scripts/frontend/auth/auth.js`
- `assets/scripts/frontend/user-bar/_notifications.js`
- `assets/scripts/frontend/user-bar/_messages.js`
- `assets/scripts/frontend/user-bar/_cart.js`
- `assets/scripts/frontend/product-form/product-form.js`
- `assets/scripts/frontend/orders/orders.js`
- `assets/scripts/frontend/reservations/reservations.js`
- `assets/scripts/frontend/stripe-connect-dashboard/stripe-connect-dashboard.js`

---

## 8. Summary for rework

- **Single shared HTML structure:** `templates/components/popup.php` and the inline template in `_static-popup.js` both output `.ts-field-popup-container` > `.ts-field-popup`. Any rework of structure or classes should consider both.
- **Search form** has its own portal in `templates/widgets/search-form.php` with one explicit container; the rest of the search UI uses `ts-popup-target` and the form-group/popup component.
- **Popup kit** is the design-time preview only; changing it updates how popups look in Style kits and in the editor, not the runtime markup elsewhere.
- **User bar, navbar, create post, timeline, product form, advanced list, collections** all rely on the shared Vue popup component or static popup and the form-group/popup pattern.
- **Styles:** One main SCSS file (`popup-kit.scss`) and several Elementor option groups drive popup appearance; rework of layout/semantics may require updates there and in the option groups that target `.ts-field-popup*`.
