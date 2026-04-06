# Yaghnob Heritage WordPress Theme

An academic portal theme designed for preserving the living Sogdian legacy of the Yaghnob Valley. Built with modern web technologies including Tailwind CSS and Alpine.js (optional), featuring a custom "Ivory" aesthetic.

## Features

-   **Academic Design:** Clean, serif-focused typography (Spectral & Inter) with an "Ivory" color palette.
-   **Custom Templates:** Specialized layouts for Dictionary, Digital Library, Gallery, and Partners.
-   **Responsive:** Fully mobile-optimized with a custom slide-over menu.
-   **Performance:** Lightweight, using Tailwind CSS via CDN (dev) or build process (prod).
-   **Accessibility:** Semantic HTML structure, ARIA labels, and high-contrast text options.

## Requirements

-   WordPress 6.0+
-   PHP 7.4+ (8.0+ recommended)

## Installation

1.  Clone this repository into your WordPress themes directory:
    ```bash
    cd wp-content/themes
    git clone https://github.com/your-org/yaghnob-heritage.git
    ```
2.  Activate the theme via the WordPress Admin Dashboard.
3.  (Optional) Import demo content.

## Theme Structure

-   `style.css` - Theme metadata and global styles.
-   `functions.php` - Theme setup, enqueue scripts, and helper functions.
-   `header.php` / `footer.php` - Global header and footer templates.
-   `index.php` - Main blog/home template.
-   `page.php` - Standard page template.
-   `page-dictionary.php` - Custom template for the interactive dictionary.
-   `page-library.php` - Custom template for the digital library.
-   `page-gallery.php` - Custom template for the visual archive.
-   `page-partners.php` - Custom template for the partners page.
-   `404.php` - Custom error page.

## Customization

The theme uses Tailwind CSS. You can customize the configuration in `functions.php` within the `tailwind.config` object injected via `wp_add_inline_script`.

## CI/CD

This project includes a GitHub Actions workflow `.github/workflows/main.yml` for:
-   PHP Syntax Checking (Linting)
-   Basic WordPress Coding Standards verification

## License

MIT License.
