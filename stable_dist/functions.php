<?php
/**
 * Yaghnob Heritage - Unbreakable Professional Version
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. EMBEDDED TRANSLATIONS (Home Page Essentials)
// This ensures that even if translations.php fails to load, the core site stays readable.
function yaghnob_get_core_translations() {
    return array(
        'site_title' => array('en' => 'Yaghnob Heritage', 'tg' => 'Мероси Яғноб', 'yai' => 'Мероси Яғноб'),
        'home' => array('en' => 'Home', 'tg' => 'Асосӣ', 'yai' => 'Асосӣ'),
        'hero_title_main' => array('en' => 'Yaghnob Heritage', 'tg' => 'Мероси Яғноб', 'yai' => 'Мероси Яғноб'),
        'hero_subtitle' => array('en' => 'Preserving the Living Sogdian Legacy', 'tg' => 'Ҳифзи мероси зиндаи Суғдиён', 'yai' => 'Ҳифзи мероси зиндаи Суғдиён'),
        'hero_desc' => array('en' => 'Exploring the linguistic and cultural depth of the Yaghnob Valley.', 'tg' => 'Таҳқиқи умқи забонӣ ва фарҳангии водии Яғноб.', 'yai' => 'Таҳқиқи умқи забонӣ ва фарҳангии водии Яғноб.')
    );
}

function tr( $key ) {
    static $full_translationsContent = null;
    $lang = ( isset( $_GET['lang'] ) && in_array( $_GET['lang'], array( 'en', 'tg', 'yai' ) ) ) ? $_GET['lang'] : (isset($_COOKIE['yaghnob_lang']) ? $_COOKIE['yaghnob_lang'] : 'en');
    
    // Core fallback
    $core = yaghnob_get_core_translations();
    if ( isset( $core[$key][$lang] ) ) return $core[$key][$lang];

    // Try full translations with safety
    if ( $full_translationsContent === null ) {
        $path = get_template_directory() . '/inc/translations.php';
        if ( file_exists( $path ) ) {
            require_once $path;
            if ( function_exists( 'yaghnob_get_translations' ) ) {
                $full_translationsContent = yaghnob_get_translations();
            }
        }
        if ($full_translationsContent === null) $full_translationsContent = array();
    }

    if ( isset( $full_translationsContent[$key][$lang] ) ) return $full_translationsContent[$key][$lang];
    return isset( $full_translationsContent[$key]['en'] ) ? $full_translationsContent[$key]['en'] : (isset($core[$key]['en']) ? $core[$key]['en'] : $key);
}

// 2. THEME SETUP
add_action( 'after_setup_theme', function() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    register_nav_menus( array( 'primary' => 'Primary Menu' ) );
} );

// 3. ASSETS (Robust Loading)
add_action( 'wp_enqueue_scripts', function() {
    // CDN with specific version for stability
    wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com?v=3.4.1&plugins=forms,typography,aspect-ratio,line-clamp', array(), null, false );
    wp_add_inline_script( 'tailwind-cdn', "
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], serif: ['Spectral', 'serif'], display: ['Cinzel', 'serif'] },
                    colors: { primary: '#C5A572', secondary: '#1c1917', ivory: '#FFFAF0' }
                }
            }
        }
    " );
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Spectral:ital,wght@0,400;0,700;1,400&family=Cinzel:wght@400;700&display=swap', array(), null );
    wp_enqueue_style( 'yaghnob-style', get_stylesheet_uri(), array(), '1.0.1' );
    
    // Icons & Animation
    wp_enqueue_script( 'lucide', 'https://unpkg.com/lucide@latest', array(), null, true );
    wp_enqueue_script( 'aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true );
    wp_enqueue_style( 'aos-css', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array(), null );
} );

// 4. THEME ACTIVATION (FORCE HOME PAGE)
add_action( 'after_switch_theme', function() {
    // 1. Check if Home page exists
    $home = get_page_by_path( 'home' );
    if ( ! $home ) {
        $home_id = wp_insert_post( array(
            'post_title' => 'Home',
            'post_name' => 'home',
            'post_status' => 'publish',
            'post_type' => 'page'
        ) );
    } else {
        $home_id = $home->ID;
    }

    // 2. Force Front Page settings
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $home_id );
    flush_rewrite_rules();
} );

// 5. HELPERS
function yaghnob_get_current_lang() {
    if ( isset( $_GET['lang'] ) && in_array( $_GET['lang'], array( 'en', 'tg', 'yai' ) ) ) return $_GET['lang'];
    return isset( $_COOKIE['yaghnob_lang'] ) ? $_COOKIE['yaghnob_lang'] : 'en';
}

function yaghnob_get_image_url( $f, $alt = 'Image' ) {
    return get_template_directory_uri() . '/assets/images/' . $f;
}

add_action( 'init', function() {
    if ( isset( $_GET['lang'] ) && !headers_sent() ) {
        setcookie( 'yaghnob_lang', $_GET['lang'], time() + 3600 * 24 * 30, '/' );
    }
} );
