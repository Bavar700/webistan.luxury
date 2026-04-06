<?php
/**
 * Yaghnob Heritage functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'yaghnob_heritage_setup' ) ) :
	function yaghnob_heritage_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'yaghnob-heritage', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Add WooCommerce support
		add_theme_support( 'woocommerce' );

		// Add Custom Logo support
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		) );

		// Register navigation menus.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'yaghnob-heritage' ),
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'yaghnob_heritage_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'yaghnob_heritage_setup' );

/**
 * Fix Rewrite Rules for Permalinks (Optimized)
 */
add_action( 'init', function() {
    // Only set structure if needed
    global $wp_rewrite;
    if ( $wp_rewrite->permalink_structure !== '/%postname%/' ) {
        $wp_rewrite->set_permalink_structure( '/%postname%/' );
    }
} );

/**
 * Auto-create pages and assign templates on theme activation (Cleaned)
 */
/**
 * Auto-create pages and assign templates on theme activation (Cleaned)
 */
function yaghnob_create_initial_pages() {
    // Safety check to only run once per version to avoid loop
    $setup_ver = 'v11_stable';
    if ( get_option( 'yaghnob_setup_done_' . $setup_ver ) ) return;

    $pages = array(
        'home'         => array( 'title' => 'Home',         'template' => 'front-page.php' ),
        'history'      => array( 'title' => 'History',      'template' => 'page-history.php' ),
        'ethnography'  => array( 'title' => 'Ethnography',  'template' => 'page-ethnography.php' ),
        'folklore'     => array( 'title' => 'Folklore',     'template' => 'page-folklore.php' ),
        'grammar'      => array( 'title' => 'Grammar',      'template' => 'page-grammar.php' ),
        'corpus'       => array( 'title' => 'Corpus',       'template' => 'page-corpus.php' ),
        'dialectology' => array( 'title' => 'Dialectology', 'template' => 'page-dialectology.php' ),
        'gallery'      => array( 'title' => 'Gallery',      'template' => 'page-gallery.php' ),
        'library'      => array( 'title' => 'Library',      'template' => 'page-library.php' ),
        'mission'      => array( 'title' => 'Mission',      'template' => 'page-mission.php' ),
        'partners'     => array( 'title' => 'Partners',     'template' => 'page-partners.php' ),
        'reports'      => array( 'title' => 'Reports',      'template' => 'page-reports.php' ),
        'media'        => array( 'title' => 'Media',        'template' => 'page-media.php' ),
    );

    $front_page_id = 0;

    foreach ( $pages as $slug => $page_data ) {
        $page_check = get_page_by_path( $slug );
        if ( ! $page_check ) {
            $page_id = wp_insert_post( array(
                'post_title'   => $page_data['title'],
                'post_name'    => $slug,
                'post_content' => '<!-- wp:paragraph --><p>Welcome to Yaghnob Heritage.</p><!-- /wp:paragraph -->',
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ) );
            if ( ! is_wp_error( $page_id ) && $page_id ) {
                update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
                if ( $slug === 'home' ) $front_page_id = $page_id;
            }
        } else {
             $page_id = $page_check->ID;
             update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
             if ( $slug === 'home' ) $front_page_id = $page_id;
        }
    }

    // Set static front page
    if ( $front_page_id ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id );
    }

    update_option( 'yaghnob_setup_done_' . $setup_ver, true );
    flush_rewrite_rules();
}
// Using a slightly delayed hook to ensure everything is ready
add_action( 'after_switch_theme', 'yaghnob_create_initial_pages' );


/**
 * Register Widget Area
 */
function yaghnob_heritage_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'yaghnob-heritage' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'yaghnob-heritage' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title text-sm font-bold uppercase tracking-wider text-white mb-4">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'yaghnob_heritage_widgets_init' );

/**
 * Handle WebP Image Fallback
 * 
 * @param string $filename Filename in assets/images/ or absolute path
 * @param string $alt_text Text for placeholder service if all else fails
 * @param string $fallback_filename Optional local fallback filename in assets/images/
 * @return string URL to the image
 */
function yaghnob_get_image_url( $filename, $alt_text = 'Image', $fallback_filename = '' ) {
    // If filename is actually an absolute path on this server
    if ( strpos( $filename, ':\\' ) !== false || strpos( $filename, '/' ) === 0 ) {
        $file_path = $filename;
    } else {
        $file_path = get_template_directory() . '/assets/images/' . $filename;
    }

    // Check if file exists
    if ( file_exists( $file_path ) ) {
        // Use proper URI function for assets in theme
        if ( strpos( $file_path, get_template_directory() ) !== false ) {
             $relative_path = str_replace( get_template_directory(), '', $file_path );
             $relative_path = ltrim( str_replace( '\\', '/', $relative_path ), '/' );
             $file_url = get_template_directory_uri() . '/' . $relative_path;
        } else {
             // Fallback for files outside theme
             $file_url = str_replace( ABSPATH, site_url( '/' ), $file_path );
             $file_url = str_replace( '\\', '/', $file_url );
        }
        
        // WebP auto-handling...
        $path_parts = pathinfo($file_path);
        $webp_filename = $path_parts['filename'] . '.webp';
        $webp_path = dirname($file_path) . '/' . $webp_filename;
        
        if ( file_exists($webp_path) ) {
             if ( strpos( $webp_path, get_template_directory() ) !== false ) {
                  $rel_webp = str_replace( get_template_directory(), '', $webp_path );
                  $rel_webp = ltrim( str_replace( '\\', '/', $rel_webp ), '/' );
                  return get_template_directory_uri() . '/' . $rel_webp;
             }
        }
        
        return $file_url;
    }

    // Check for local fallback file if provided
    if ( ! empty( $fallback_filename ) ) {
        return yaghnob_get_image_url( $fallback_filename, $alt_text );
    }

    // Return a placeholder service URL if file is missing
    return 'https://placehold.co/800x600/EEE/31343C?text=' . urlencode( $alt_text );
}
/**
 * Enqueue scripts and styles.
 */
/**
 * Safe include translations with caching
 */
function yaghnob_get_all_translations() {
    static $cache = null;
    if ( $cache !== null ) {
        return $cache;
    }
    
    // Using __DIR__ for absolute reliability
    $path = __DIR__ . '/inc/translations.php';
    if ( file_exists( $path ) ) {
        require_once $path;
        if ( function_exists( 'yaghnob_get_translations' ) ) {
            $cache = yaghnob_get_translations();
            return $cache;
        }
    }
    
    // Minimal fallback array if file is missing/error
    $cache = array(
        'hero_title_main' => array('en' => 'Yaghnob', 'tg' => 'Яғноб', 'yai' => 'Яғноб'),
        'hero_subtitle'   => array('en' => 'Preserving the Sogdian Legacy', 'tg' => 'Ҳифзи мероси Суғд', 'yai' => 'Ҳифзи мероси Суғд'),
    );
    return $cache;
}

/**
 * Get current language
 */
function yaghnob_get_current_lang() {
    if ( isset( $_GET['lang'] ) && in_array( $_GET['lang'], array( 'en', 'tg', 'yai' ) ) ) {
        return $_GET['lang'];
    }
    return isset( $_COOKIE['yaghnob_lang'] ) ? $_COOKIE['yaghnob_lang'] : 'en';
}

/**
 * Handle language cookie before headers are sent
 */
add_action( 'init', function() {
    if ( isset( $_GET['lang'] ) && in_array( $_GET['lang'], array( 'en', 'tg', 'yai' ) ) ) {
        if ( ! headers_sent() ) {
            setcookie( 'yaghnob_lang', $_GET['lang'], time() + 3600 * 24 * 30, '/' );
        }
    }
} );

/**
 * Get translation by key (Optimized with cache)
 */
function yaghnob_tr( $key ) {
    $translations = yaghnob_get_all_translations();
    $lang = yaghnob_get_current_lang();
    
    if ( isset( $translations[$key][$lang] ) ) {
        return $translations[$key][$lang];
    }
    
    // Fallback to English
    return isset( $translations[$key]['en'] ) ? $translations[$key]['en'] : $key;
}


/**
 * Helper to localize timestamp
 */
function yaghnob_localize_timestamp( $timestamp ) {
    $lang = yaghnob_get_current_lang();
    
    if ( $lang === 'en' ) {
        return date( get_option( 'date_format' ), $timestamp );
    }
    
    // For Tajik/Yaghnobi
    $day = date( 'j', $timestamp );
    $year = date( 'Y', $timestamp );
    $month_num = date( 'n', $timestamp );
    
    // Map month number to translation key
    $month_keys = array(
        1 => 'month_jan',
        2 => 'month_feb',
        3 => 'month_mar',
        4 => 'month_apr',
        5 => 'month_may',
        6 => 'month_jun',
        7 => 'month_jul',
        8 => 'month_aug',
        9 => 'month_sep',
        10 => 'month_oct',
        11 => 'month_nov',
        12 => 'month_dec'
    );
    
    $month_name = yaghnob_tr( $month_keys[$month_num] );
    
    // Format: 18 February, 2026
    return sprintf( '%s %s, %s', $month_name, $day, $year );
}

/**
 * Get localized date
 */
function yaghnob_get_localized_date( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    
    $timestamp = get_post_time( 'U', false, $post_id );
    return yaghnob_localize_timestamp( $timestamp );
}

/**
 * Get localized comment date
 */
function yaghnob_get_localized_comment_date( $comment_id = 0 ) {
    $comment = get_comment( $comment_id );
    if ( ! $comment ) {
        return '';
    }
    $timestamp = strtotime( $comment->comment_date );
    return yaghnob_localize_timestamp( $timestamp );
}

/**
 * Translate default comment author
 */
function yaghnob_translate_comment_author( $author ) {
    if ( $author === 'A WordPress Commenter' ) {
        return yaghnob_tr( 'default_comment_author' );
    }
    return $author;
}
add_filter( 'get_comment_author', 'yaghnob_translate_comment_author' );

/**
 * Translate default comment text
 */
function yaghnob_translate_comment_text( $comment_text ) {
    // Check if it's the default comment
    if ( strpos( $comment_text, 'Hi, this is a comment.' ) !== false ) {
        // We use nl2br because yaghnob_tr() returns text with newlines, but comment text is usually HTML or auto-paragraphed
        return nl2br( yaghnob_tr( 'default_comment_text' ) );
    }
    return $comment_text;
}
add_filter( 'get_comment_text', 'yaghnob_translate_comment_text' );

function yaghnob_heritage_scripts() {
	// Enqueue Google Fonts (Inter + Spectral + Cinzel)
	wp_enqueue_style( 'yaghnob-heritage-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Spectral:ital,wght@0,300;0,400;0,600;0,700;1,400&family=Cinzel:wght@400;500;600;700;800;900&display=swap&subset=latin,cyrillic', array(), null );

	// Enqueue Tailwind CSS (Play CDN for development with plugins)
	wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp', array(), null, false );

	// Configure Tailwind Theme
	wp_add_inline_script( 'tailwind-cdn', "
		tailwind.config = {
			theme: {
				extend: {
					fontFamily: {
						sans: ['Inter', 'sans-serif'],
						serif: ['Spectral', 'serif'],
						display: ['Cinzel', 'serif'],
					},
					colors: {
						primary: '#C5A572',
						secondary: '#1c1917',
						ivory: '#FFFAF0',
					}
				}
			}
		}
	" );

	// Enqueue AOS (Animate On Scroll)
	wp_enqueue_style( 'aos-css', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array(), null );
	wp_enqueue_script( 'aos-js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true );

	// Enqueue Lucide Icons
	wp_enqueue_script( 'lucide', 'https://unpkg.com/lucide@latest', array(), null, true );

	// Enqueue navigation script
	wp_enqueue_script( 'yaghnob-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0.0', true );

	// Enqueue main stylesheet
	wp_enqueue_style( 'yaghnob-heritage-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'yaghnob_heritage_scripts' );

/**
 * Handle Contact Form Submission
 */
function yaghnob_handle_contact_form() {
    // Verify Nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'yaghnob_contact_nonce' ) ) {
        wp_send_json_error( array( 'message' => yaghnob_tr('error_security_token') ) );
    }

    // Validate Inputs
    $name    = sanitize_text_field( $_POST['name'] );
    $email   = sanitize_email( $_POST['email'] );
    $message = sanitize_textarea_field( $_POST['message'] );

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => yaghnob_tr('error_fields_required') ) );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => yaghnob_tr('error_invalid_email') ) );
    }

    // Prepare Email
    $to      = 'admin@yaghnob.com';
    $subject = 'New Contact Message from ' . $name;
    $body    = "Name: $name\n";
    $body   .= "Email: $email\n\n";
    $body   .= "Message:\n$message\n";
    $headers = array( 'Content-Type: text/plain; charset=UTF-8', 'From: ' . $name . ' <' . $email . '>' );

    // Send Email
    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( array( 'message' => yaghnob_tr('contact_success') ) );
    } else {
        // Fallback for development environments where mail might not work
        // In production, you'd want to log the error and return false
        error_log( 'Mail failed to send: ' . print_r( error_get_last(), true ) );
        wp_send_json_error( array( 'message' => yaghnob_tr('error_send_failed') ) );
    }
}
add_action( 'wp_ajax_yaghnob_contact_form', 'yaghnob_handle_contact_form' );
add_action( 'wp_ajax_nopriv_yaghnob_contact_form', 'yaghnob_handle_contact_form' );

