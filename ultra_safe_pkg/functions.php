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
 * Fix Rewrite Rules for Permalinks
 * Manually injects verbose page rules and a post rule to ensure correct routing.
 */
add_action( 'init', function() {
    // Ensure permalink structure is set
    global $wp_rewrite;
    if ( $wp_rewrite->permalink_structure !== '/%postname%/' ) {
        $wp_rewrite->set_permalink_structure( '/%postname%/' );
    }

    // Only flush if absolutely necessary (e.g. once on theme switch, managed via option)
    if ( ! get_option( 'yaghnob_rewrite_rules_fixed_v5' ) ) {
        flush_rewrite_rules();
        update_option( 'yaghnob_rewrite_rules_fixed_v5', true );
    }
} );

/**
 * Auto-create pages and assign templates on theme activation
 */
function yaghnob_create_initial_pages() {
    $pages = array(
        'history' => array(
            'title' => 'History',
            'template' => 'page-history.php'
        ),
        'ethnography' => array(
            'title' => 'Ethnography',
            'template' => 'page-ethnography.php'
        ),
        'folklore' => array(
            'title' => 'Folklore',
            'template' => 'page-folklore.php'
        ),
        'grammar' => array(
            'title' => 'Grammar',
            'template' => 'page-grammar.php'
        ),
        'corpus' => array(
            'title' => 'Corpus',
            'template' => 'page-corpus.php'
        ),
        'dialectology' => array(
            'title' => 'Dialectology',
            'template' => 'page-dialectology.php'
        ),
        'gallery' => array(
            'title' => 'Gallery',
            'template' => 'page-gallery.php'
        ),
        'library' => array(
            'title' => 'Library',
            'template' => 'page-library.php'
        ),
        'mission' => array(
            'title' => 'Mission',
            'template' => 'page-mission.php'
        ),
        'partners' => array(
            'title' => 'Partners',
            'template' => 'page-partners.php'
        ),
        'reports' => array(
            'title' => 'Reports',
            'template' => 'page-reports.php'
        ),
        'media' => array(
            'title' => 'Media',
            'template' => 'page-media.php'
        ),
    );

    foreach ( $pages as $slug => $page_data ) {
        // Check if page exists
        $page_check = get_page_by_path( $slug );
        $page_id = -1;

        if ( ! $page_check ) {
            // Create page
            $page_id = wp_insert_post( array(
                'post_title'   => $page_data['title'],
                'post_name'    => $slug,
                'post_content' => '',
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ) );
        } else {
            $page_id = $page_check->ID;
        }

        // Assign template if page exists
        if ( $page_id > 0 ) {
            update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
        }
    }
}
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
    // Determine full path
    if ( file_exists( $filename ) ) {
        $file_path = $filename;
    } else {
        $file_path = get_template_directory() . '/assets/images/' . $filename;
    }

    // Check if file exists
    if ( file_exists( $file_path ) ) {
        $file_url = str_replace( ABSPATH, site_url( '/' ), $file_path );
        $file_url = str_replace( '\\', '/', $file_url ); // Fix Windows paths
        
        // If the path was constructed manually, use the standard URI function for cleaner URLs
        if ( strpos( $file_path, get_template_directory() ) !== false ) {
             $file_url = get_template_directory_uri() . '/assets/images/' . basename($file_path);
        }
        
        // Check for WebP version
        $path_parts = pathinfo($file_path);
        $webp_filename = $path_parts['filename'] . '.webp';
        $webp_path = dirname($file_path) . '/' . $webp_filename;
        
        if ( file_exists($webp_path) ) {
             // If inside template directory, return clean URL
             if ( strpos( $webp_path, get_template_directory() ) !== false ) {
                 return get_template_directory_uri() . '/assets/images/' . $webp_filename;
             }
             // Otherwise return mapped URL
             $webp_url = str_replace( ABSPATH, site_url( '/' ), $webp_path );
             return str_replace( '\\', '/', $webp_url );
        }
        
        // Auto-convert to WebP if GD is available and file is writable
        if ( is_writable( dirname($file_path) ) && function_exists('imagewebp') ) {
            $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
            $image = null;
            
            switch ($ext) {
                case 'jpg':
                case 'jpeg':
                    $image = @imagecreatefromjpeg($file_path);
                    break;
                case 'png':
                    $image = @imagecreatefrompng($file_path);
                    if ($image) {
                        imagepalettetotruecolor($image);
                        imagealphablending($image, true);
                        imagesavealpha($image, true);
                    }
                    break;
            }

            if ($image) {
                // Save as WebP with 85% quality
                if ( @imagewebp($image, $webp_path, 85) ) {
                    imagedestroy($image);
                    if ( strpos( $webp_path, get_template_directory() ) !== false ) {
                        return get_template_directory_uri() . '/assets/images/' . $webp_filename;
                    }
                    $webp_url = str_replace( ABSPATH, site_url( '/' ), $webp_path );
                    return str_replace( '\\', '/', $webp_url );
                }
                imagedestroy($image);
            }
        }
        
        return $file_url;
    }

    // Check for local fallback file if provided
    if ( ! empty( $fallback_filename ) ) {
        $fallback_path = get_template_directory() . '/assets/images/' . $fallback_filename;
        
        if ( file_exists( $fallback_path ) ) {
            // Recursive call to handle WebP for fallback too
            return yaghnob_get_image_url( $fallback_filename, $alt_text );
        }
    }

    // Return a placeholder service URL if file is missing
    return 'https://placehold.co/800x600/EEE/31343C?text=' . urlencode( $alt_text );
}
/**
 * Enqueue scripts and styles.
 */
require_once get_template_directory() . '/inc/translations.php';

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
function yaghnob_handle_language_cookie() {
    if ( isset( $_GET['lang'] ) && in_array( $_GET['lang'], array( 'en', 'tg', 'yai' ) ) ) {
        setcookie( 'yaghnob_lang', $_GET['lang'], time() + 3600 * 24 * 30, '/' );
    }
}
add_action( 'init', 'yaghnob_handle_language_cookie' );

/**
 * Get translation by key
 */
function tr( $key ) {
    $translations = yaghnob_get_translations();
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
    
    $month_name = tr( $month_keys[$month_num] );
    
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
        return tr( 'default_comment_author' );
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
        // We use nl2br because tr() returns text with newlines, but comment text is usually HTML or auto-paragraphed
        return nl2br( tr( 'default_comment_text' ) );
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
        wp_send_json_error( array( 'message' => tr('error_security_token') ) );
    }

    // Validate Inputs
    $name    = sanitize_text_field( $_POST['name'] );
    $email   = sanitize_email( $_POST['email'] );
    $message = sanitize_textarea_field( $_POST['message'] );

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => tr('error_fields_required') ) );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => tr('error_invalid_email') ) );
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
        wp_send_json_success( array( 'message' => tr('contact_success') ) );
    } else {
        // Fallback for development environments where mail might not work
        // In production, you'd want to log the error and return false
        error_log( 'Mail failed to send: ' . print_r( error_get_last(), true ) );
        wp_send_json_error( array( 'message' => tr('error_send_failed') ) );
    }
}
add_action( 'wp_ajax_yaghnob_contact_form', 'yaghnob_handle_contact_form' );
add_action( 'wp_ajax_nopriv_yaghnob_contact_form', 'yaghnob_handle_contact_form' );
