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
    
    // Google Fonts: Inter
    wp_enqueue_style( 'nexoz-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap', array(), null );
    
    // Custom Style (just in case)
    wp_enqueue_style( 'nexoz-main', get_stylesheet_uri(), array('nexoz-fonts'), '1.0.0' );
    
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
