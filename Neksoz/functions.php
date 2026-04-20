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
    
    // Google Fonts: Montserrat, Noto Serif (Standard for high-end editorial and universal support)
    wp_enqueue_style( 'nexoz-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Inter:wght@300;400;500;600;700;800;900&family=Mr+Dafoe&display=swap', array(), null );
    
    // Main Style (Minified)
    wp_enqueue_style( 'nexoz-main', get_template_directory_uri() . '/style.min.css', array('nexoz-fonts'), '1.0.3' );
    
    // Main JavaScript (Minified)
    wp_enqueue_script( 'nexoz-main-js', get_template_directory_uri() . '/main.min.js', array('jquery'), '1.0.3', true );

    // Localize
    wp_localize_script( 'nexoz-main-js', 'neksozAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'neksoz_nonce' )
    ));

    // DISABLE ADMIN BAR to prevent design shifts
    add_filter('show_admin_bar', '__return_false');
    
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
                        sans: ['Montserrat', 'sans-serif'],
                        serif: ['Noto Serif', 'serif'],
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
    register_post_type( 'nk_service', array(
        'labels' => array(
            'name' => 'Услуги',
            'singular_name' => 'Услуга'
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'service-item'),
        'menu_icon' => 'dashicons-briefcase',
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest' => true,
    ));

    // Cases
    register_post_type( 'cases', array(
        'labels' => array(
            'name' => 'Кейсы',
            'singular_name' => 'Кейс'
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
    echo '<img src="' . esc_url( $logo_url ) . '" alt="Нексоз" class="h-10 w-auto">';
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
        'vacancies-tj'        => array('title' => 'Ҷойҳои корӣ', 'template' => 'page-vacancies-tj.php'),
        'vacancies-en'        => array('title' => 'Vacancies', 'template' => 'page-vacancies-en.php'),
        'news'                => array('title' => 'Новости', 'template' => 'page-news.php'),
        'news-tj'             => array('title' => 'Ахбор', 'template' => 'page-news-tj.php'),
        'news-en'             => array('title' => 'News', 'template' => 'page-news-en.php'),
        'about-tj'            => array('title' => 'Дар бораи мо', 'template' => 'page-about-tj.php'),
        'about-en'            => array('title' => 'About Us', 'template' => 'page-about-en.php'),
        'services-tj'         => array('title' => 'Хидматрасониҳо', 'template' => 'page-services-tj.php'),
        'services-en'         => array('title' => 'Services', 'template' => 'page-services-en.php'),
        'contacts-tj'         => array('title' => 'Тамос', 'template' => 'page-contacts-tj.php'),
        'contacts-en'         => array('title' => 'Contacts', 'template' => 'page-contacts-en.php'),
        'team'                => array('title' => 'Команда', 'template' => 'page-team.php'),
        'team-tj'             => array('title' => 'Дастаи мо', 'template' => 'page-team-tj.php'),
        'team-en'             => array('title' => 'Our Team', 'template' => 'page-team-en.php'),
        'privacy-policy'      => array('title' => 'Политика конфиденциальности', 'template' => 'page-privacy.php'),
        'privacy-policy-tj'   => array('title' => 'Сиёсати махфият', 'template' => 'page-privacy-tj.php'),
        'privacy-policy-en'   => array('title' => 'Privacy Policy', 'template' => 'page-privacy-en.php'),
        'terms'               => array('title' => 'Условия использования', 'template' => 'page-terms.php'),
        'terms-tj'            => array('title' => 'Шартҳои истифода', 'template' => 'page-terms-tj.php'),
        'terms-en'            => array('title' => 'Terms of Use', 'template' => 'page-terms-en.php'),
        
        // Tajik Services
        'service-audit-tj'    => array('title' => 'Аудити фаъолияти молиявӣ', 'template' => 'service-audit-tj.php'),
        'service-restore-tj'  => array('title' => 'Барқарорсозии баҳисобгирии молиявӣ', 'template' => 'service-restore-tj.php'),
        'service-legal-tj'    => array('title' => 'Дастгирии ҳуқуқӣ', 'template' => 'service-legal-tj.php'),
        'service-accounting-tj' => array('title' => 'Пешбурди баҳисобгирии молиявӣ ва кадрӣ', 'template' => 'service-accounting-tj.php'),
        'service-secretariat-tj' => array('title' => 'Хидматрасониҳои секретариат', 'template' => 'service-secretariat-tj.php'),
        'service-consulting-tj' => array('title' => 'Машваратҳои тиҷоратӣ', 'template' => 'service-consulting-tj.php'),
        'service-tax-tj'      => array('title' => 'Машваратҳои андозӣ', 'template' => 'service-tax-tj.php'),
        'service-management-tj' => array('title' => 'Баҳисобгирии идоракунӣ', 'template' => 'service-management-tj.php'),
        'service-automation-tj' => array('title' => 'Автоматикунонии равандҳои тиҷоратӣ', 'template' => 'service-automation-tj.php'),
        'service-planning-tj' => array('title' => 'Бақайдгирии тиҷорат', 'template' => 'service-planning-tj.php'), 
        
        // English Services
        'service-audit-en'    => array('title' => 'Financial Audit', 'template' => 'service-audit-en.php'),
        'service-restore-en'  => array('title' => 'Accounting Restoration', 'template' => 'service-restore-en.php'),
        'service-legal-en'    => array('title' => 'Legal Consultations', 'template' => 'service-legal-en.php'),
        'service-accounting-en' => array('title' => 'Financial & HR Accounting', 'template' => 'service-accounting-en.php'),
        'service-secretariat-en' => array('title' => 'Secretariat Services', 'template' => 'service-secretariat-en.php'),
        'service-consulting-en' => array('title' => 'Business Consulting', 'template' => 'service-consulting-en.php'),
        'service-tax-en'      => array('title' => 'Tax Consultations', 'template' => 'service-tax-en.php'),
        'service-management-en' => array('title' => 'Management Accounting', 'template' => 'service-management-en.php'),
        'service-automation-en' => array('title' => 'Business Automation', 'template' => 'service-automation-en.php'),
        'service-planning-en' => array('title' => 'Business Planning', 'template' => 'service-planning-en.php'),
        'service-business-plan' => array('title' => 'Разработка бизнес-планов и ТЭО', 'template' => 'service-business-plan.php'),
        'service-business-plan-tj' => array('title' => 'Таҳияи бизнес-план ва АТЭ', 'template' => 'service-business-plan-tj.php'),
        'service-business-plan-en' => array('title' => 'Business Planning & FS', 'template' => 'service-business-plan-en.php'),
    );

    $created_any = false;
    foreach ($pages as $slug => $data) {
        $page_check = get_page_by_path($slug);
        if (!isset($page_check->ID)) {
            $page_id = wp_insert_post(array(
                'post_type'   => 'page',
                'post_title'  => $data['title'],
                'post_name'   => $slug,
                'post_status' => 'publish',
                'post_author' => 1,
            ));
            if ($page_id) {
                update_post_meta($page_id, '_wp_page_template', $data['template']);
                $created_any = true;
            }
        } else {
            // Ensure template is correct even if page exists
            update_post_meta($page_check->ID, '_wp_page_template', $data['template']);
        }
    }
    
    if ($created_any || !get_option('nk_flush_v4')) {
        flush_rewrite_rules();
        update_option('nk_flush_v4', true);
    }

    // Auto-create Category 'tj'
    if (!get_category_by_slug('tj')) {
        wp_insert_term('Тоҷикӣ', 'category', array('slug' => 'tj'));
    }
    if (!get_category_by_slug('en')) {
        wp_insert_term('English', 'category', array('slug' => 'en'));
    }

    // Auto-create news posts for links to work
    $posts_to_ensure = [
        ['title' => 'Тағйирот дар ҳисоби андоз аз амвол ва замин', 'cat' => 'tj'],
        ['title' => 'Равандҳои муфлисшавӣ ва барҳамдиҳии корхонаҳо', 'cat' => 'tj'],
        ['title' => 'Натиҷаҳои ҳамоиши иқтисодӣ дар Душанбе', 'cat' => 'tj'],
        ['title' => 'Изменения в расчете налога на имущество и землю', 'cat' => ''],
        ['title' => 'Процедуры банкротства и ликвидации предприятий', 'cat' => ''],
        ['title' => 'Итоги экономического форума в Душанбе', 'cat' => ''],
        ['title' => 'Changes in Property and Land Tax Calculation', 'cat' => 'en'],
        ['title' => 'Bankruptcy and Corporate Liquidation Procedures', 'cat' => 'en'],
        ['title' => 'Outcomes of the Economic Forum in Dushanbe', 'cat' => 'en']
    ];

    foreach ($posts_to_ensure as $p) {
        if (!get_page_by_title($p['title'], OBJECT, 'post')) {
            $pid = wp_insert_post(array(
                'post_title' => $p['title'],
                'post_content' => 'Ин маводи хабарӣ ба таври худкор барои низоми сезабона сохта шудааст.',
                'post_status' => 'publish',
                'post_type' => 'post'
            ));
            if ($pid && $p['cat'] != '') {
                $cid = get_category_by_slug($p['cat']);
                if ($cid) wp_set_post_categories($pid, array($cid->term_id));
            }
        }
    }
}
add_action('init', 'nexoz_auto_create_pages');

function nk_get_current_lang() {
    if (isset($_GET["lang"])) {
        return sanitize_text_field($_GET["lang"]);
    }
    return "ru"; 
}

function nk_link($path, $lang) {
    if ($path === '/' || $path === '') {
        return home_url('/?lang=' . $lang);
    }
    
    $clean_slug = trim($path, '/');
    // Remove existing lang suffix if any
    $base_slug = preg_replace('/-(tj|en)$/', '', $clean_slug);
    
    $target_slug = $base_slug;
    if ($lang === 'tj') $target_slug .= '-tj';
    elseif ($lang === 'en') $target_slug .= '-en';
    
    return home_url('/' . $target_slug . '/?lang=' . $lang);
}

function nk_get_switcher_link($lang, $current_slug) {
    // Guard: empty slug → homepage
    if (empty($current_slug)) {
        return add_query_arg('lang', $lang, home_url('/'));
    }

    // ── Single post (news/blog) ──────────────────────────────────────────────
    // On single posts the slug contains date paths like "2024/12/post-name"
    // which cannot be language-switched via slug suffix. Send to news archive.
    if (is_singular('post') || strpos($current_slug, '/') !== false) {
        $news_map = array(
            'ru' => 'news',
            'tj' => 'news-tj',
            'en' => 'news-en',
        );
        $archive_slug = isset($news_map[$lang]) ? $news_map[$lang] : 'news';
        return home_url('/' . $archive_slug . '/?lang=' . $lang);
    }

    // ── Single custom post type (nk_service, cases, etc.) ───────────────────
    // These would also have unknown URL structures — fall back to services list
    if (is_singular() && !is_page()) {
        $post_type = get_post_type();
        if ($post_type === 'nk_service' || $post_type === 'cases') {
            $services_map = array(
                'ru' => 'services',
                'tj' => 'services-tj',
                'en' => 'services-en',
            );
            $archive_slug = isset($services_map[$lang]) ? $services_map[$lang] : 'services';
            return home_url('/' . $archive_slug . '/?lang=' . $lang);
        }
        // Generic CPT fallback → homepage
        return add_query_arg('lang', $lang, home_url('/'));
    }

    // ── Standard page slug (most common case) ────────────────────────────────
    $base_slug = preg_replace('/-(tj|en)$/', '', $current_slug);

    $target_slug = $base_slug;
    if ($lang === 'tj') $target_slug .= '-tj';
    elseif ($lang === 'en') $target_slug .= '-en';

    return home_url('/' . $target_slug . '/?lang=' . $lang);
}

/**
 * CONTENT PROTECTION - Guest Mode Only
 * Protects text and assets from easy copying while excluding forms and providing bypass for Admins.
 */
function neksoz_content_protection() {
    if ( is_user_logged_in() ) return; // Bypass for logged-in admins
    ?>
    <style>
        /* CSS Protection */
        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Essential Exclusion: Form fields must remain interactive */
        input, textarea, select, .cta-crystal__field *, button {
            -webkit-user-select: text !important;
            -moz-user-select: text !important;
            -ms-user-select: text !important;
            user-select: text !important;
        }

        /* Image Drag Protection */
        img {
            -webkit-user-drag: none;
            user-drag: none;
            pointer-events: none; /* Disables standard right-click context for images */
        }
    </style>

    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());

        document.addEventListener('keydown', function(e) {
            // Block Ctrl (or Cmd) + C, A, S, U
            if ((e.ctrlKey || e.metaKey) && (e.keyCode === 67 || e.keyCode === 65 || e.keyCode === 83 || e.keyCode === 85)) {
                e.preventDefault();
                return false;
            }
            // Block F12
            if (e.keyCode === 123) {
                e.preventDefault();
                return false;
            }
            // Block Ctrl+Shift+I / J / C
            if (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74 || e.keyCode === 67)) {
                e.preventDefault();
                return false;
            }
        });

        // Prevent dragging on all images via JS as fallback
        window.addEventListener('load', function() {
            document.querySelectorAll('img').forEach(img => {
                img.setAttribute('draggable', 'false');
            });
        });
    </script>
    <?php
}
add_action('wp_head', 'neksoz_content_protection', 99);

/**
 * DYNAMIC ENGINE - Polylang & Menu Registration
 */
function neksoz_dynamic_init() {
    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu (Header)', 'neksoz'),
        'footer'  => __('Footer Menu', 'neksoz'),
        'legal'   => __('Legal Menu (Footer)', 'neksoz')
    ));

    // Register Polylang Strings for UI elements
    if (function_exists('pll_register_string')) {
        pll_register_string('Neksoz Badge', 'PREMIUM CONSULTING', 'Neksoz UI');
        pll_register_string('Neksoz Badge 2', 'Neksoz Academy', 'Neksoz UI');
        pll_register_string('Neksoz CTA', 'Связаться с нами', 'Neksoz UI');
        pll_register_string('Neksoz Form Title', 'Оставьте заявку', 'Neksoz UI');
        pll_register_string('Neksoz Contact Phone', '+992 44 600 00 00', 'Neksoz Global');
        pll_register_string('Neksoz Contact Email', 'info@webistan.tj', 'Neksoz Global');
        pll_register_string('Neksoz Contact Address', 'Rudaki Ave 42, Dushanbe', 'Neksoz Global');
        pll_register_string('Neksoz Legal Rights', 'Все права защищены.', 'Neksoz Footer');
    }
}
add_action('init', 'neksoz_dynamic_init');

/**
 * 5. PERFORMANCE: Defer Non-Critical Scripts
 */
function neksoz_optimize_scripts($tag, $handle) {
    if (is_admin()) return $tag;
    if (in_array($handle, array('nexoz-main-js', 'jquery-core', 'tailwind'))) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'neksoz_optimize_scripts', 10, 2);

/**
 * 6. SECURITY: AJAX Lead Handler with Honeypot
 */
function neksoz_ajax_lead_handler() {
    // 1. Nonce Check
    check_ajax_referer('neksoz_nonce', 'nonce');

    // 2. Honeypot check (nk_hp) - If filled, it's a bot
    if (!empty($_POST['nk_hp'])) {
        wp_send_json_error('Spam detected.');
    }

    // 3. Sanitize Data
    $name    = sanitize_text_field($_POST['name']);
    $phone   = sanitize_text_field($_POST['phone']);
    $service = sanitize_text_field($_POST['service']);
    $message = sanitize_textarea_field($_POST['message']);

    // 4. Send Email
    $to = get_option('admin_email');
    $subject = 'Новая заявка: ' . $service;
    $body = "Имя: $name\nТелефон: $phone\nУслуга: $service\nСообщение: $message";
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    if (wp_mail($to, $subject, $body, $headers)) {
        wp_send_json_success('Спасибо! Ваша заявка отправлена.');
    } else {
        wp_send_json_error('Ошибка при отправке.');
    }
}
add_action('wp_ajax_send_lead', 'neksoz_ajax_lead_handler');
add_action('wp_ajax_nopriv_send_lead', 'neksoz_ajax_lead_handler');
