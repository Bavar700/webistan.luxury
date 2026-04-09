<?php
/**
 * Nexoz Corporate Theme Functions
 * Registered by Senior WordPress Developer / UI/UX Designer
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* 1. Theme Setup */
function nexoz_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'nexoz' ),
        'footer'  => __( 'Footer Menu', 'nexoz' ),
    ) );
}
add_action( 'after_setup_theme', 'nexoz_setup' );

/* 2. Enqueue Scripts & Styles */
function nexoz_scripts() {
    // Tailwind CSS CDN (Script for JIT)
    wp_enqueue_script( 'tailwind', 'https://cdn.tailwindcss.com', array(), null, false );
    
    // Google Fonts: Inter, Rock Salt & Playfair Display (Solid/Classic)
    wp_enqueue_style( 'nexoz-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&family=Rock+Salt&family=Playfair+Display:ital,wght@0,700;1,700&display=swap', array(), null );
    
    // Custom Style (just in case)
    wp_enqueue_style( 'nexoz-main', get_stylesheet_uri(), array('nexoz-fonts'), time() );
    
    // Tailwind Config (Inline)
    wp_add_inline_script( 'tailwind', "
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#001F3F',
                        ivory: '#FDFCFB',
                        'accent-red': '#E30613',
                        'accent-blue': '#0044CC',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    ", 'before' );
}
add_action( 'wp_enqueue_scripts', 'nexoz_scripts' );

/* 3. Register Custom Post Types */
function nexoz_register_cpts() {
    // Services
    register_post_type( 'services', array(
        'labels' => array(
            'name' => 'Ð£ÑÐ»ÑƒÐ³Ð¸',
            'singular_name' => 'Ð£ÑÐ»ÑƒÐ³Ð°'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-briefcase',
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest' => true,
    ));

    // Cases
    register_post_type( 'cases', array(
        'labels' => array(
            'name' => 'ÐšÐµÐ¹ÑÑ‹',
            'singular_name' => 'ÐšÐµÐ¹Ñ'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-analytics',
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest' => true,
    ));
}
add_action( 'init', 'nexoz_register_cpts' );

/* 4. Helper: Logo */
function nexoz_the_logo() {
    $logo_url = get_template_directory_uri() . '/assets/images/logo.png';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="flex items-center">';
    echo '<img src="' . esc_url( $logo_url ) . '" alt="ÐÐµÐºÑÐ¾Ð·" class="h-10 w-auto">';
    echo '</a>';
}

/* 5. Automatic Page Setup (Auto-fix for 404s) */
function nexoz_auto_create_pages() {
    $pages = array(
        'service-audit'      => array('title' => 'Аудит финансовой деятельности', 'template' => 'service-audit.php'),
        'service-restore'    => array('title' => 'Восстановление финансового учета', 'template' => 'service-restore.php'),
        'service-legal'      => array('title' => 'Юридические консультации', 'template' => 'service-legal.php'),
        'service-accounting'   => array('title' => 'Ведение финансового учета', 'template' => 'service-accounting.php'),
        'service-secretariat' => array('title' => 'Услуги секретариата', 'template' => 'service-secretariat.php'),
        'service-consulting'  => array('title' => 'Бизнес-консультации', 'template' => 'service-consulting.php'),
        'service-tax'         => array('title' => 'Налоговые консультации', 'template' => 'service-tax.php'),
        'service-management'  => array('title' => 'Управленческий учет', 'template' => 'service-management.php'),
        'service-automation'  => array('title' => 'Автоматизация бизнес-процессов', 'template' => 'service-automation.php'),
        'about'               => array('title' => 'О компании', 'template' => 'page-about.php'),
        'services'            => array('title' => 'Наши услуги', 'template' => 'page-services.php'),
        'contacts'            => array('title' => 'Контакты', 'template' => 'page-contacts.php'),
        'vacancies'           => array('title' => 'Вакансии', 'template' => 'page-vacancies.php'),
        'news'                => array('title' => 'Новости', 'template' => 'page-news.php'),
    );

    foreach ($pages as $slug => $data) {
        $page_check = get_page_by_path($slug);
        if (!isset($page_check->ID)) {
            $page_id = wp_insert_post(array(
                'post_type'   => 'page',
                'post_title'  => $data['title'],
                'post_name'   => $slug,
                'post_status' => 'publish',
            ));
            if ($page_id) {
                update_post_meta($page_id, '_wp_page_template', $data['template']);
            }
        }
    }
}
add_action('init', 'nexoz_auto_create_pages');

/* ============================================================ */
/* LANGUAGE SWITCHER LOGIC                                        */
/* ============================================================ */
function nk_get_current_lang() {
    if (isset($_GET["lang"])) {
        $lang = sanitize_text_field($_GET["lang"]);
        setcookie("nk_lang", $lang, time() + YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
        return $lang;
    } elseif (isset($_COOKIE["nk_lang"])) {
        return $_COOKIE["nk_lang"];
    }
    return "ru"; // Default
}

