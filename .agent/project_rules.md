# Project Rules: Senior WordPress & UI/UX Architect

## Core Mission
Create a strictly academic, minimalist WordPress theme using a high-performance stack.

## Tech Stack & Tooling
- **Scaffolding**: Clean WP structure (`functions.php`, `template-parts/`, `inc/`).
- **CSS Engine**: Tailwind CSS + Custom CSS (Vite/PostCSS compatible).
- **Build System**: Vite for HMR and asset minification.
- **Blocks**: Custom Gutenberg blocks with React.

## Design Constraints (STRICT)
- **Palette**: 
    - Academic Ivory (`#F5F5F0`) - Primary background.
    - Light Grey (`#E5E5E5`) - Accents/Sections.
    - Deep Navy/Charcoal - Primary text and borders.
- **FORBIDDEN**: Yellowish, beige, or golden background tones are strictly prohibited.
- **Effects**: Glassmorphism (`backdrop-filter: blur()`) for headers and navigation.
- **Typography**: Classical hierarchical scale (Inter/Lora), oxygen-heavy layout (high whitespace).

## Autonomous Task Protocols
1. **Browser Validation**: Test every UI changes in the browser (Desktop & Mobile).
2. **Code Quality**: Run linting/standard checks before finalizing code.
3. **Optimization**: Monitor performance (Core Web Vitals).

## Interaction Protocol
1. **Plan of Action**: Provide a plan in Manager View before major edits.
2. **Documentation**: Maintain `README.md` with hooks and filters.

## Responsive Design Strict Separation (Dandoni Solim)
- **NEVER** modify `mobile_v169.css` when the user requests changes to the desktop version.
- **NEVER** modify `desktop_v169.css` when the user requests changes to the mobile version.
- **Always** ensure these two environments are strictly separated.
