<?php
/**
 * Функции и настройки темы Neksoz.Luxury
 *
 * @package Neksoz
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'NEKSOZ_VERSION', '1.0.0' );
define( 'NEKSOZ_DIR', get_template_directory() );
define( 'NEKSOZ_URI', get_template_directory_uri() );

/* ==========================================================================
   1. Theme Setup
   ========================================================================== */

if ( ! function_exists( 'neksoz_setup' ) ) :
    function neksoz_setup() {
        // Поддержка перевода
        load_theme_textdomain( 'neksoz', NEKSOZ_DIR . '/languages' );

        // WordPress управляет <title>
        add_theme_support( 'title-tag' );

        // Автоматические ссылки на фиды
        add_theme_support( 'automatic-feed-links' );

        // Поддержка миниатюр записей
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'neksoz-featured', 1200, 600, true );
        add_image_size( 'neksoz-card', 600, 400, true );
        add_image_size( 'neksoz-thumbnail', 400, 300, true );

        // Регистрация меню навигации
        register_nav_menus( array(
            'primary' => __( 'Главное меню', 'neksoz' ),
            'footer'  => __( 'Меню в подвале', 'neksoz' ),
        ) );

        // Поддержка HTML5
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ) );

        // Поддержка пользовательского логотипа
        add_theme_support( 'custom-logo', array(
            'height'      => 80,
            'width'       => 300,
            'flex-height' => true,
            'flex-width'  => true,
        ) );

        // Широкие и полноширинные изображения (для Gutenberg)
        add_theme_support( 'align-wide' );

        // Редактор стилей Gutenberg
        add_theme_support( 'editor-styles' );
    }
endif;
add_action( 'after_setup_theme', 'neksoz_setup' );

/* ==========================================================================
   2. Enqueue Scripts & Styles
   ========================================================================== */

function neksoz_scripts() {
    // Google Fonts: Montserrat + Inter
    wp_enqueue_style(
        'neksoz-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@500;600;700;800&display=swap',
        array(),
        null
    );

    // Slick Slider CSS
    wp_enqueue_style(
        'slick-css',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
        array(),
        '1.8.1'
    );

    wp_enqueue_style(
        'slick-theme-css',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css',
        array( 'slick-css' ),
        '1.8.1'
    );

    // Theme stylesheet
    wp_enqueue_style(
        'neksoz-style',
        get_stylesheet_uri(),
        array( 'neksoz-google-fonts', 'slick-css' ),
        NEKSOZ_VERSION
    );

    // jQuery (already included in WP)
    wp_enqueue_script( 'jquery' );

    // Slick Slider JS
    wp_enqueue_script(
        'slick-js',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
        array( 'jquery' ),
        '1.8.1',
        true
    );

    // Theme JS
    wp_enqueue_script(
        'neksoz-main',
        NEKSOZ_URI . '/assets/js/main.js',
        array( 'jquery', 'slick-js' ),
        NEKSOZ_VERSION,
        true
    );

    // Localize for AJAX
    wp_localize_script( 'neksoz-main', 'neksozAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'neksoz_contact_nonce' ),
    ) );

    // Comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'neksoz_scripts' );

/* ==========================================================================
   3. Register Sidebars / Widget Areas
   ========================================================================== */

function neksoz_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Боковая панель', 'neksoz' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Область виджетов для боковой панели.', 'neksoz' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Подвал — Колонка 1', 'neksoz' ),
        'id'            => 'footer-1',
        'description'   => __( 'Первая колонка подвала.', 'neksoz' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'neksoz_widgets_init' );

/* ==========================================================================
   4. Custom Post Type: Услуги (Services)
   ========================================================================== */

function neksoz_register_cpt_services() {
    $labels = array(
        'name'               => __( 'Услуги', 'neksoz' ),
        'singular_name'      => __( 'Услуга', 'neksoz' ),
        'add_new'            => __( 'Добавить услугу', 'neksoz' ),
        'add_new_item'       => __( 'Добавить новую услугу', 'neksoz' ),
        'edit_item'          => __( 'Редактировать услугу', 'neksoz' ),
        'new_item'           => __( 'Новая услуга', 'neksoz' ),
        'view_item'          => __( 'Просмотр услуги', 'neksoz' ),
        'search_items'       => __( 'Поиск услуг', 'neksoz' ),
        'not_found'          => __( 'Услуги не найдены', 'neksoz' ),
        'not_found_in_trash' => __( 'В корзине услуг нет', 'neksoz' ),
        'all_items'          => __( 'Все услуги', 'neksoz' ),
        'menu_name'          => __( 'Услуги', 'neksoz' ),
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'services' ),
        'menu_icon'     => 'dashicons-briefcase',
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'  => true,
    );

    register_post_type( 'neksoz_service', $args );
}
add_action( 'init', 'neksoz_register_cpt_services' );

/* ==========================================================================
   5. AJAX Contact Form Handler
   ========================================================================== */

function neksoz_handle_contact_form() {
    check_ajax_referer( 'neksoz_contact_nonce', 'nonce' );

    $name    = sanitize_text_field( $_POST['name'] ?? '' );
    $email   = sanitize_email( $_POST['email'] ?? '' );
    $phone   = sanitize_text_field( $_POST['phone'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => __( 'Пожалуйста, заполните все обязательные поля.', 'neksoz' ) ) );
    }

    $admin_email = get_option( 'admin_email' );
    $subject     = sprintf( __( 'Новая заявка с сайта NEKSOZ от %s', 'neksoz' ), $name );

    $body  = sprintf( __( "Имя: %s\n", 'neksoz' ), $name );
    $body .= sprintf( __( "Email: %s\n", 'neksoz' ), $email );
    $body .= sprintf( __( "Телефон: %s\n", 'neksoz' ), $phone );
    $body .= sprintf( __( "Сообщение:\n%s", 'neksoz' ), $message );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    $sent = wp_mail( $admin_email, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( array( 'message' => __( 'Спасибо! Ваше сообщение отправлено. Мы свяжемся с Вами в ближайшее время.', 'neksoz' ) ) );
    } else {
        wp_send_json_error( array( 'message' => __( 'Произошла ошибка. Попробуйте позже или свяжитесь с нами по телефону.', 'neksoz' ) ) );
    }
}
add_action( 'wp_ajax_neksoz_contact', 'neksoz_handle_contact_form' );
add_action( 'wp_ajax_nopriv_neksoz_contact', 'neksoz_handle_contact_form' );

/* ==========================================================================
   6. Helper Functions
   ========================================================================== */

/**
 * Выводит логотип или текст
 */
function neksoz_the_logo() {
    if ( has_custom_logo() ) {
        the_custom_logo();
    } else {
        echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="nk-brand" rel="home">';
        echo '<img src="' . NEKSOZ_URI . '/assets/img/neksoz-logo.png" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="nk-brand__logo">';
        echo '</a>';
    }
}

/**
 * Получает иконку для услуги (SVG)
 */
function neksoz_service_icon( $icon_name = 'briefcase' ) {
    $icons = array(
        'audit'       => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 14l2 2 4-4"/></svg>',
        'tax'         => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M7 15h0M2 9.5h20"/></svg>',
        'legal'       => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
        'accounting'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="8" y1="10" x2="16" y2="10"/><line x1="8" y1="14" x2="12" y2="14"/></svg>',
        'restore'     => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>',
        'consulting'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'briefcase'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>',
    );

    return isset( $icons[ $icon_name ] ) ? $icons[ $icon_name ] : $icons['briefcase'];
}
