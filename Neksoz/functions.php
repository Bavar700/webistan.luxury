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
    wp_enqueue_script( 'tailwind', 'https://cdn.tailwindcss.com', array(), null, false );
    wp_enqueue_style( 'nexoz-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Inter:wght@300;400;500;600;700;800;900&family=Mr+Dafoe&display=swap', array(), null );
    wp_enqueue_style( 'nexoz-main', get_template_directory_uri() . '/style.min.css', array('nexoz-fonts'), '1.0.3' );
    wp_enqueue_script( 'nexoz-main-js', get_template_directory_uri() . '/main.min.js', array('jquery'), '1.0.3', true );
    wp_localize_script( 'nexoz-main-js', 'neksozAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'neksoz_nonce' )
    ));
    add_filter('show_admin_bar', '__return_false');
    wp_add_inline_script( 'tailwind', "
        tailwind.config = {
            theme: {
                extend: {
                    colors: { navy: '#001F3F', ivory: '#FDFCFB', 'accent-red': '#E30613', 'accent-blue': '#0044CC' },
                    fontFamily: { sans: ['Montserrat', 'sans-serif'], serif: ['Noto Serif', 'serif'] }
                }
            }
        }
    ", 'before' );
}
add_action( 'wp_enqueue_scripts', 'nexoz_scripts' );

/* 3. Register Custom Post Types */
function nexoz_register_cpts() {
    register_post_type( 'nk_service', array(
        'labels' => array('name' => 'Услуги', 'singular_name' => 'Услуга'),
        'public' => true, 'has_archive' => false, 'rewrite' => array('slug' => 'service-item'),
        'menu_icon' => 'dashicons-briefcase', 'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ), 'show_in_rest' => true,
    ));
    register_post_type( 'cases', array(
        'labels' => array('name' => 'Кейсы', 'singular_name' => 'Кейс'),
        'public' => true, 'has_archive' => true, 'menu_icon' => 'dashicons-analytics',
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ), 'show_in_rest' => true,
    ));
}
add_action( 'init', 'nexoz_register_cpts' );

function nexoz_flush_on_activation() {
    nexoz_register_cpts();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'nexoz_flush_on_activation' );

function nexoz_the_logo() {
    $logo_url = get_template_directory_uri() . '/logo.png';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="flex items-center"><img src="' . esc_url( $logo_url ) . '" alt="Нексоз" class="h-10 w-auto"></a>';
}

/* 5. Automatic Page Setup */
function nexoz_auto_create_pages() {
    $pages = array(
        'about' => array('title' => 'О компании', 'template' => 'page-about.php'),
        'services' => array('title' => 'Наши услуги', 'template' => 'page-services.php'),
        'contacts' => array('title' => 'Контакты', 'template' => 'page-contacts.php'),
        'news' => array('title' => 'Новости', 'template' => 'page-news.php'),
        'news-tj' => array('title' => 'Ахбор', 'template' => 'page-news-tj.php'),
        'news-en' => array('title' => 'News', 'template' => 'page-news-en.php'),
        'team' => array('title' => 'Команда', 'template' => 'page-team.php'),
        'team-tj' => array('title' => 'Дастаи мо', 'template' => 'page-team-tj.php'),
        'team-en' => array('title' => 'Our Team', 'template' => 'page-team-en.php'),
    );
    foreach ($pages as $slug => $data) {
        $page_check = get_page_by_path($slug);
        if (!isset($page_check->ID)) {
            $page_id = wp_insert_post(array('post_type'=>'page','post_title'=>$data['title'],'post_name'=>$slug,'post_status'=>'publish','post_author'=>1));
            if ($page_id) update_post_meta($page_id, '_wp_page_template', $data['template']);
        }
    }
    
    // Auto-create News Category
    if (!get_term_by('slug', 'tj', 'category')) wp_insert_term('TJ', 'category', array('slug' => 'tj'));
    if (!get_term_by('slug', 'en', 'category')) wp_insert_term('EN', 'category', array('slug' => 'en'));

    // FORCE DELETE LONG OUTSOURCING POSTS (Requested by user)
    $to_delete = [
        'АУТСОРСИНГОВАЯ ДЕЯТЕЛЬНОСТЬ КАК ИНСТРУМЕНТ ОПТИМИЗАЦИИ ХОЗЯЙСТВЕННОЙ ДЕЯТЕЛЬНОСТИ ПРЕДПРИЯТИЙ В УСЛОВИЯХ РЫНОЧНОЙ ЭКОНОМИКИ',
        'ФАЪОЛИЯТИ АУТСОРСИНГӢ ҲАМЧУН ВОСИТАИ ОПТИМИЗАТСИЯИ ФАЪОЛИЯТИ ХОҶАГИДОРИИ КОРХОНАҲО ДАР ШАРОИТИ ИҚТИСОДИ БОЗОРӢ',
        'OUTSOURCING ACTIVITY AS A TOOL FOR OPTIMIZING THE ECONOMIC ACTIVITIES OF ENTERPRISES IN A MARKET ECONOMY',
        'Outsourcing Activity as a Tool for Optimizing Economic Activities'
    ];
    foreach ($to_delete as $title) {
        $p = get_page_by_title($title, OBJECT, 'post');
        if ($p) wp_delete_post($p->ID, true);
    }
}
add_action('init', 'nexoz_auto_create_pages');

/* 
   CRITICAL: TRILINGUAL ROUTING SYSTEM (DO NOT MODIFY)
   This system is the heart of the site's localization. 
   Modifying these functions will break navigation across RU, TJ, and EN.
   Refer to DEVELOPMENT_RULES.md before making changes.
*/
function nk_get_current_lang() {
    return isset($_GET["lang"]) ? sanitize_text_field($_GET["lang"]) : "ru"; 
}

function nk_link($path, $lang) {
    // If it's already a full external URL, return as is
    if (preg_match('/^https?:\/\//', $path) && strpos($path, home_url()) === false) {
        return $path;
    }

    // Separate path and query string if present
    $parts = explode('?', $path);
    $base_path = $parts[0];
    
    // Handle home specifically
    if ($base_path === '/' || $base_path === '' || $base_path === home_url('/')) {
        return add_query_arg('lang', $lang, home_url('/'));
    }
    
    // Extract slug from path or full home URL
    $clean_slug = str_replace(home_url(), '', $base_path);
    $clean_slug = trim($clean_slug, '/');
    
    // Remove existing language suffixes (-tj, -en)
    $base_slug = preg_replace('/-(tj|en)$/', '', $clean_slug);
    
    $target_slug = $base_slug;
    if ($lang === 'tj') $target_slug .= '-tj';
    elseif ($lang === 'en') $target_slug .= '-en';
    
    $url = home_url('/' . $target_slug . '/');
    return add_query_arg('lang', $lang, $url);
}

function nk_get_switcher_link($lang, $current_slug) {
    if (empty($current_slug) || $current_slug === 'front-page') {
        return add_query_arg('lang', $lang, home_url('/'));
    }
    
    // For single posts, we map the category/archive
    if (is_singular('post')) {
        $news_map = array('ru' => 'news', 'tj' => 'news-tj', 'en' => 'news-en');
        $archive_slug = isset($news_map[$lang]) ? $news_map[$lang] : 'news';
        return add_query_arg('lang', $lang, home_url('/' . $archive_slug . '/'));
    }
    
    // For pages, use nk_link
    return nk_link($current_slug, $lang);
}

function neksoz_content_protection() {
    if ( is_user_logged_in() ) return;
    ?>
    <style>
        body { -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; }
        input, textarea, select, .cta-crystal__field *, button { -webkit-user-select: text !important; -moz-user-select: text !important; -ms-user-select: text !important; user-select: text !important; }
        img { -webkit-user-drag: none; user-drag: none; pointer-events: none; }
    </style>
    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && (e.keyCode === 67 || e.keyCode === 65 || e.keyCode === 83 || e.keyCode === 85)) { e.preventDefault(); return false; }
            if (e.keyCode === 123) { e.preventDefault(); return false; }
            if (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74 || e.keyCode === 67)) { e.preventDefault(); return false; }
        });
    </script>
    <?php
}

function neksoz_dynamic_init() {
    register_nav_menus(array(
        'primary' => __('Primary Menu (Header)', 'neksoz'),
        'footer'  => __('Footer Menu', 'neksoz'),
        'legal'   => __('Legal Menu (Footer)', 'neksoz')
    ));
    if (function_exists('pll_register_string')) {
        pll_register_string('Neksoz Badge', 'PREMIUM CONSULTING', 'Neksoz UI');
        pll_register_string('Neksoz Badge 2', 'Neksoz Academy', 'Neksoz UI');
        pll_register_string('Neksoz CTA', 'Связаться с нами', 'Neksoz UI');
        pll_register_string('Neksoz Form Title', 'Оставьте заявку', 'Neksoz UI');
        pll_register_string('Neksoz Legal Rights', 'Все права защищены.', 'Neksoz Footer');
    }
}
add_action('init', 'neksoz_dynamic_init');

function neksoz_ajax_lead_handler() {
    check_ajax_referer('neksoz_nonce', 'nonce');
    if (!empty($_POST['nk_hp'])) wp_send_json_error('Spam detected.');
    $name = sanitize_text_field($_POST['name']);
    $phone = sanitize_text_field($_POST['phone']);
    $service = sanitize_text_field($_POST['service']);
    $message = sanitize_textarea_field($_POST['message']);
    $to = get_option('admin_email');
    $subject = 'Новая заявка: ' . $service;
    $body = "Имя: $name\nТелефон: $phone\nУслуга: $service\nСообщение: $message";
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    if (wp_mail($to, $subject, $body, $headers)) wp_send_json_success('Спасибо! Ваша заявка отправлена.');
    else wp_send_json_error('Ошибка при отправке.');
}
add_action('wp_ajax_send_lead', 'neksoz_ajax_lead_handler');
add_action('wp_ajax_nopriv_send_lead', 'neksoz_ajax_lead_handler');

/**
 * CLEAN CASING HELPER (Sentence Case for All-Caps)
 */
function neksoz_clean_title_case($title) {
    if (mb_strtoupper($title, "UTF-8") === $title && mb_strlen($title) > 5) {
        $lower = mb_strtolower($title, "UTF-8");
        $clean = mb_strtoupper(mb_substr($lower, 0, 1, "UTF-8"), "UTF-8") . mb_substr($lower, 1, null, "UTF-8");
        if (stripos($clean, 'Аутсорсинг') !== false || stripos($clean, 'Фаъолияти') !== false) {
            $clean = rtrim($clean, '.');
        }
        return $clean;
    }
    return $title;
}
