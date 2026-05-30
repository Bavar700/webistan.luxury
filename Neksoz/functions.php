<?php
/**
 * Nexoz Corporate Theme Functions
 * Registered by Senior WordPress Developer / UI/UX Designer
 */

if (!defined('ABSPATH'))
    exit;

/* 1. Theme Setup */
function nexoz_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'nexoz'),
        'footer' => __('Footer Menu', 'nexoz'),
    ));
}
add_action('after_setup_theme', 'nexoz_setup');

/* 2. Enqueue Scripts & Styles */
function nexoz_scripts()
{
    wp_enqueue_script('tailwind', 'https://cdn.tailwindcss.com', array(), null, false);
    wp_enqueue_style('nexoz-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Inter:wght@300;400;500;600;700;800;900&family=Mr+Dafoe&display=swap', array(), null);
    wp_enqueue_style('nexoz-main', get_template_directory_uri() . '/style.min.css', array('nexoz-fonts'), time());
    wp_enqueue_script('nexoz-main-js', get_template_directory_uri() . '/main.min.js', array('jquery'), time(), true);
    wp_localize_script('nexoz-main-js', 'neksozAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('neksoz_nonce')
    ));
    add_filter('show_admin_bar', '__return_false');
    wp_add_inline_script('tailwind', "
        tailwind.config = {
            theme: {
                extend: {
                    colors: { navy: '#001F3F', ivory: '#FDFCFB', 'accent-red': '#E30613', 'accent-blue': '#0044CC' },
                    fontFamily: { sans: ['Montserrat', 'sans-serif'], serif: ['Noto Serif', 'serif'] }
                }
            }
        }
    ", 'before');
}
add_action('wp_enqueue_scripts', 'nexoz_scripts');

/* 3. Register Custom Post Types */
function nexoz_register_cpts()
{
    register_post_type('nk_service', array(
        'labels' => array('name' => 'Услуги', 'singular_name' => 'Услуга'),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'service-item'),
        'menu_icon' => 'dashicons-briefcase',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    ));
    register_post_type('cases', array(
        'labels' => array('name' => 'Кейсы', 'singular_name' => 'Кейс'),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-analytics',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'nexoz_register_cpts');

function nexoz_flush_on_activation()
{
    nexoz_register_cpts();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'nexoz_flush_on_activation');

function nexoz_the_logo()
{
    $logo_url = get_template_directory_uri() . '/logo.png';
    $current_lang = function_exists('nk_get_current_lang') ? nk_get_current_lang() : 'ru';
    echo '<a href="' . esc_url(nk_link('/', $current_lang)) . '" class="flex items-center"><img src="' . esc_url($logo_url) . '" alt="Нексоз" class="h-10 w-auto"></a>';
}

/* 5. Automatic Page Setup */
function nexoz_auto_create_pages()
{
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
            $page_id = wp_insert_post(array('post_type' => 'page', 'post_title' => $data['title'], 'post_name' => $slug, 'post_status' => 'publish', 'post_author' => 1));
            if ($page_id)
                update_post_meta($page_id, '_wp_page_template', $data['template']);
        }
    }

    // Auto-create News Category
    if (!get_term_by('slug', 'tj', 'category'))
        wp_insert_term('TJ', 'category', array('slug' => 'tj'));
    if (!get_term_by('slug', 'en', 'category'))
        wp_insert_term('EN', 'category', array('slug' => 'en'));

    // FORCE DELETE LONG OUTSOURCING POSTS (Requested by user)
    $to_delete = [
        'АУТСОРСИНГОВАЯ ДЕЯТЕЛЬНОСТЬ КАК ИНСТРУМЕНТ ОПТИМИЗАЦИИ ХОЗЯЙСТВЕННОЙ ДЕЯТЕЛЬНОСТИ ПРЕДПРИЯТИЙ В УСЛОВИЯХ РЫНОЧНОЙ ЭКОНОМИКИ',
        'ФАЪОЛИЯТИ АУТСОРСИНГӢ ҲАМЧУН ВОСИТАИ ОПТИМИЗАТСИЯИ ФАЪОЛИЯТИ ХОҶАГИДОРИИ КОРХОНАҲО ДАР ШАРОИТИ ИҚТИСОДИ БОЗОРӢ',
        'OUTSOURCING ACTIVITY AS A TOOL FOR OPTIMIZING THE ECONOMIC ACTIVITIES OF ENTERPRISES IN A MARKET ECONOMY',
        'Outsourcing Activity as a Tool for Optimizing Economic Activities'
    ];
    foreach ($to_delete as $title) {
        $p = get_page_by_title($title, OBJECT, 'post');
        if ($p)
            wp_delete_post($p->ID, true);
    }
}
add_action('init', 'nexoz_auto_create_pages');

/* 
   CRITICAL: TRILINGUAL ROUTING SYSTEM (DO NOT MODIFY)
   This system is the heart of the site's localization. 
   Modifying these functions will break navigation across RU, TJ, and EN.
   Refer to DEVELOPMENT_RULES.md before making changes.
*/
function nk_get_current_lang()
{
    return isset($_GET["lang"]) ? sanitize_text_field($_GET["lang"]) : "ru";
}

function nk_link($path, $lang)
{
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
    if ($lang === 'tj')
        $target_slug .= '-tj';
    elseif ($lang === 'en')
        $target_slug .= '-en';

    $url = home_url('/' . $target_slug . '/');
    return add_query_arg('lang', $lang, $url);
}

function nk_get_switcher_link($lang, $current_slug)
{
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

function neksoz_content_protection()
{
    if (is_user_logged_in())
        return;
    ?>
    <style>
        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        input,
        textarea,
        select,
        .cta-crystal__field *,
        button {
            -webkit-user-select: text !important;
            -moz-user-select: text !important;
            -ms-user-select: text !important;
            user-select: text !important;
        }

        img {
            -webkit-user-drag: none;
            user-drag: none;
            pointer-events: none;
        }
    </style>
    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
        document.addEventListener('keydown', function (e) {
            if ((e.ctrlKey || e.metaKey) && (e.keyCode === 67 || e.keyCode === 65 || e.keyCode === 83 || e.keyCode === 85)) { e.preventDefault(); return false; }
            if (e.keyCode === 123) { e.preventDefault(); return false; }
            if (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74 || e.keyCode === 67)) { e.preventDefault(); return false; }
        });
    </script>
    <?php
}

function neksoz_dynamic_init()
{
    register_nav_menus(array(
        'primary' => __('Primary Menu (Header)', 'neksoz'),
        'footer' => __('Footer Menu', 'neksoz'),
        'legal' => __('Legal Menu (Footer)', 'neksoz')
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

function neksoz_ajax_lead_handler()
{
    check_ajax_referer('neksoz_nonce', 'nonce');
    if (!empty($_POST['nk_hp']))
        wp_send_json_error('Spam detected.');
    $name = sanitize_text_field($_POST['name']);
    $phone = sanitize_text_field($_POST['phone']);
    $service = sanitize_text_field($_POST['service']);
    $message = sanitize_textarea_field($_POST['message']);
    $to = get_option('admin_email');
    $subject = 'Новая заявка: ' . $service;
    $body = "Имя: $name\nТелефон: $phone\nУслуга: $service\nСообщение: $message";
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    if (wp_mail($to, $subject, $body, $headers))
        wp_send_json_success('Спасибо! Ваша заявка отправлена.');
    else
        wp_send_json_error('Ошибка при отправке.');
}
add_action('wp_ajax_send_lead', 'neksoz_ajax_lead_handler');
add_action('wp_ajax_nopriv_send_lead', 'neksoz_ajax_lead_handler');

/**
 * CLEAN CASING HELPER (Sentence Case for All-Caps)
 */
function neksoz_clean_title_case($title)
{
    if (mb_strtoupper($title, "UTF-8") === $title && mb_strlen($title) > 5) {
        $lower = mb_strtolower($title, "UTF-8");
        $clean = mb_strtoupper(mb_substr($lower, 0, 1, "UTF-8"), "UTF-8") . mb_substr($lower, 1, null, "UTF-8");
        return $clean;
    }
    return $title;
}

function neksoz_auto_seed_news() {
    // 0. Delete "Hello World" (ID 1) to clean up noise
    wp_delete_post(1, true);

    // 1. Ensure categories exist with correct slugs
    if (!term_exists('tj', 'category')) wp_insert_term('Tajik', 'category', array('slug' => 'tj'));
    if (!term_exists('en', 'category')) wp_insert_term('English', 'category', array('slug' => 'en'));

    $tj_cat = get_term_by('slug', 'tj', 'category');
    $en_cat = get_term_by('slug', 'en', 'category');

    $news_items = array(
        // RU
        array('title' => 'АУТСОРСИНГОВАЯ ДЕЯТЕЛЬНОСТЬ', 'content' => 'Аутсорсинговая деятельность как инструмент оптимизации хозяйственной деятельности предприятий.', 'lang' => 'ru'),
        array('title' => 'Изменения в расчете налога на имущество и землю', 'content' => 'Согласно ст. 175 и 402 Налогового кодекса, налоги напрямую зависят от кадастровой стоимости.', 'lang' => 'ru'),
        array('title' => 'Процедуры банкротства и ликвидации предприятий', 'content' => 'Команда NEKSOZ объединяет экспертов в области права для проведения процедур банкротства.', 'lang' => 'ru'),
        array('title' => 'Итоги экономического форума в Душанбе', 'content' => 'Обсуждаем новые векторы развития инвестиционного климата после форума.', 'lang' => 'ru'),
        // TJ
        array('title' => 'ФАЪОЛИЯТИ АУТСОРСИНГӢ', 'content' => 'Фаъолияти аутсорсингӣ ҳамчун воситаи оптимизатсияи фаъолияти хоҷагидории корхонаҳо.', 'lang' => 'tj', 'cat' => ($tj_cat ? $tj_cat->term_id : 0)),
        array('title' => 'Тағйирот дар ҳисоби андоз аз амвол ва замин', 'content' => 'Тибқи моддаҳои 175 ва 402-и Кодекси андоз, андозҳо мустақиман ба арзиши кадастрӣ вобастаанд.', 'lang' => 'tj', 'cat' => ($tj_cat ? $tj_cat->term_id : 0)),
        array('title' => 'Равандҳои муфлисшавӣ ва барҳамдиҳии корхонаҳо', 'content' => 'Ҳайати кории NEKSOZ коршиносони соҳаи ҳуқуқро муттаҳид месозад.', 'lang' => 'tj', 'cat' => ($tj_cat ? $tj_cat->term_id : 0)),
        array('title' => 'Натиҷаҳои ҳамоиши иқтисодӣ дар Душанбе', 'content' => 'Самтҳои нави рушди фазои сармоягузориро баррасӣ мекунем.', 'lang' => 'tj', 'cat' => ($tj_cat ? $tj_cat->term_id : 0)),
        // EN
        array('title' => 'OUTSOURCING ACTIVITY', 'content' => 'Outsourcing activity as a tool for optimizing the economic activities of enterprises.', 'lang' => 'en', 'cat' => ($en_cat ? $en_cat->term_id : 0)),
        array('title' => 'Changes in Property and Land Tax Calculation', 'content' => 'According to Articles 175 and 402 of the Tax Code, taxes depend directly on cadastral value.', 'lang' => 'en', 'cat' => ($en_cat ? $en_cat->term_id : 0)),
        array('title' => 'Bankruptcy and Corporate Liquidation Procedures', 'content' => 'The NEKSOZ team brings together legal experts for bankruptcy procedures.', 'lang' => 'en', 'cat' => ($en_cat ? $en_cat->term_id : 0)),
        array('title' => 'Outcomes of the Economic Forum in Dushanbe', 'content' => 'Discussing new vectors of investment climate development after the forum.', 'lang' => 'en', 'cat' => ($en_cat ? $en_cat->term_id : 0))
    );

    foreach ($news_items as $item) {
        $existing = get_page_by_title($item['title'], OBJECT, 'post');
        if (!$existing) {
            $post_id = wp_insert_post(array(
                'post_title'   => $item['title'],
                'post_content' => $item['content'],
                'post_status'  => 'publish',
                'post_type'    => 'post',
                'post_author'  => 1
            ));
        } else {
            $post_id = $existing->ID;
        }

        // Forced category reassignment to fix "mixing" or "empty sidebar"
        if ($post_id && isset($item['cat']) && $item['cat'] > 0) {
            wp_set_post_categories($post_id, array($item['cat']));
        }
    }
}

function neksoz_bulletproof_auto_create_pages() {
    // Also seed news
    neksoz_auto_seed_news();

    // Manual trigger or on theme activation
    if (!isset($_GET['force_create_pages']) && !isset($_GET['activated'])) {
        // Only run once per hour to save resources
        if (get_transient('neksoz_pages_created')) return;
    }

    $theme_dir = get_template_directory();
    $files = scandir($theme_dir);
    $created = false;

    foreach ($files as $filename) {
        if (strpos($filename, 'page-') === 0 || strpos($filename, 'service-') === 0) {
            if (pathinfo($filename, PATHINFO_EXTENSION) !== 'php') continue;
            
            $base_name = str_replace('.php', '', $filename);
            
            // LOGIC: Get correct slug
            if (strpos($base_name, 'page-') === 0) {
                $slug = substr($base_name, 5); // remove 'page-'
            } else {
                $slug = $base_name; // keep 'service-'
            }

            // MAPPING: Fix special cases (Privacy Policy)
            $slug_map = array(
                'privacy' => 'privacy-policy',
                'privacy-tj' => 'privacy-policy-tj',
                'privacy-en' => 'privacy-policy-en'
            );
            if (isset($slug_map[$slug])) {
                $slug = $slug_map[$slug];
            }

            // Skip base page.php
            if ($slug === 'page' || $slug === '') continue;

            // Use Query to avoid get_page_by_path issues with caching
            $existing = new WP_Query(array(
                'post_type' => 'page',
                'name' => $slug,
                'posts_per_page' => 1,
                'post_status' => 'any'
            ));

            if (!$existing->have_posts()) {
                $title = ucwords(str_replace('-', ' ', $slug));
                $page_id = wp_insert_post(array(
                    'post_type'   => 'page',
                    'post_title'  => $title,
                    'post_name'   => $slug,
                    'post_status' => 'publish',
                    'post_author' => 1
                ));
                if ($page_id) {
                    update_post_meta($page_id, '_wp_page_template', $filename);
                    $created = true;
                }
            } else {
                $p = $existing->posts[0];
                update_post_meta($p->ID, '_wp_page_template', $filename);
            }
        }
    }

    if ($created) {
        flush_rewrite_rules();
    }
    set_transient('neksoz_pages_created', true, HOUR_IN_SECONDS);
    
    if (isset($_GET['force_create_pages'])) {
        wp_die('All pages checked and ensured. <a href="' . home_url() . '">Back to home</a>');
    }
}
add_action("init", "neksoz_bulletproof_auto_create_pages");

