<?php
/*
Plugin Name: Neksoz B2B Reviews System
Plugin URI: https://neksoz.tj
Description: Автономная система B2B-отзывов. Карусель Swiper.js, Glassmorphism дизайн, импорт реальных отзывов.
Version: 1.3
Author: Senior Web Developer
*/

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * 1. Регистрация CPT b2b_reviews
 */
function neksoz_b2b_register_cpt() {
    register_post_type('b2b_reviews', array(
        'labels' => array(
            'name' => 'B2B Отзывы',
            'singular_name' => 'Отзыв',
            'add_new' => 'Добавить отзыв',
            'all_items' => 'Все отзывы',
        ),
        'public' => true,
        'show_ui' => true,
        'menu_icon' => 'dashicons-awards',
        'supports' => array('title'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'neksoz_b2b_register_cpt');

/**
 * 2. Метабоксы
 */
function neksoz_b2b_add_metaboxes() {
    add_meta_box('b2b_details', 'Детали отзыва', 'neksoz_b2b_render_metabox', 'b2b_reviews', 'normal', 'high');
}
add_action('add_meta_boxes', 'neksoz_b2b_add_metaboxes');

function neksoz_b2b_render_metabox($post) {
    wp_nonce_field('b2b_save', 'b2b_nonce');
    $fields = array(
        '_b2b_company' => 'Компания и должность',
        '_b2b_result'  => 'Результат (цифры)',
        '_b2b_text'    => 'Текст отзыва',
        '_b2b_letter'  => 'Ссылка на скан письма (PDF/JPG)',
        '_b2b_reply'   => 'Ответ Neksoz'
    );
    foreach ($fields as $key => $label) {
        $val = get_post_meta($post->ID, $key, true);
        echo '<p><strong>'.$label.':</strong><br>';
        if ($key === '_b2b_text' || $key === '_b2b_reply') {
            echo '<textarea name="'.$key.'" style="width:100%" rows="4">'.esc_textarea($val).'</textarea></p>';
        } else {
            echo '<input type="text" name="'.$key.'" value="'.esc_attr($val).'" style="width:100%"></p>';
        }
    }
}

function neksoz_b2b_save_meta($post_id) {
    if (!isset($_POST['b2b_nonce']) || !wp_verify_nonce($_POST['b2b_nonce'], 'b2b_save')) return;
    $keys = array('_b2b_company', '_b2b_result', '_b2b_text', '_b2b_letter', '_b2b_reply');
    foreach ($keys as $key) {
        if (isset($_POST[$key])) update_post_meta($post_id, $key, sanitize_textarea_field($_POST[$key]));
    }
}
add_action('save_post', 'neksoz_b2b_save_meta');

/**
 * 3. Ассеты Swiper.js
 */
function neksoz_b2b_enqueue_assets() {
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'neksoz_b2b_enqueue_assets');

/**
 * 4. Шорткод карусели [b2b_carousel]
 */
function neksoz_b2b_carousel_shortcode() {
    $lang = function_exists('nk_get_current_lang') ? nk_get_current_lang() : 'ru';
    
    $labels = array(
        'ru' => array(
            'verified' => 'Официальный отзыв', 
            'result' => 'Результат проекта',
            'RESULT_EFFICIENCY' => 'Рост эффективности на 40%',
            'RESULT_STABILITY' => 'Устойчивое развитие бизнеса',
            'RESULT_RISKS' => 'Минимизация бизнес-рисков',
            'DIRECTOR_TICRO' => 'Директор ‘TICRO’',
            'DIRECTOR_TOTAL' => 'Директор ‘Total Service’',
            'DIRECTOR_AMERICAN' => 'Директор ‘American School’',
            'TEXT_USMONOV' => 'Создали хорошую рабочую атмосферу, пунктуальны, дружелюбны, подали вкусный чай и конечно дали дельные советы. Спасибо ребята и успехов вам!',
            'TEXT_AMRIDINOVA' => 'Благодарим за долговременное плодотворное сотрудничество! Приятно иметь дело с профессионалами своего дела — всегда быстро, четко и по делу.',
            'TEXT_VEYN' => 'Ребята ваш сервис действительно соответсвует вашему профессионализму. Думаю здесь выбор очевиден. Спасибо вам!',
            'NAME_USMONOV' => 'Фахриддин Усмонов',
            'NAME_AMRIDINOVA' => 'Амридинова Сайёра',
            'NAME_VEYN' => 'Кассиди Вейн'
        ),
        'tj' => array(
            'verified' => 'Назари расмӣ', 
            'result' => 'Натиҷаи лоиҳа',
            'RESULT_EFFICIENCY' => 'Афзоиши самаранокӣ то 40%',
            'RESULT_STABILITY' => 'Рушди устувори тиҷорат',
            'RESULT_RISKS' => 'Паст кардани хавфҳои тиҷоратӣ',
            'DIRECTOR_TICRO' => 'Директори ‘TICRO’',
            'DIRECTOR_TOTAL' => 'Директори ‘Total Service’',
            'DIRECTOR_AMERICAN' => 'Директори ‘American School’',
            'TEXT_USMONOV' => 'Фазои хуби корӣ фароҳам оварданд, дақиқкор, дӯстона, чойи хуштамъ пешкаш карданд ва албатта маслиҳатҳои муфид доданд. Ташаккур ба бачаҳо ва барори кор!',
            'TEXT_AMRIDINOVA' => 'Барои ҳамкории дарозмуддати пурсамар миннатдорем! Бо касбиёни кори худ ҳамкорӣ кардан гуворо аст — ҳамеша зуд, дақиқ ва мувофиқи мақсад.',
            'TEXT_VEYN' => 'Бачаҳо, хидматрасонии шумо воқеан ба касбияти шумо мувофиқат мекунад. Фикр мекунам, интихоб дар ин ҷо равшан аст. Ташаккур ба шумо!',
            'NAME_USMONOV' => 'Фахриддин Усмонов',
            'NAME_AMRIDINOVA' => 'Амридинова Сайёра',
            'NAME_VEYN' => 'Кассиди Вейн'
        ),
        'en' => array(
            'verified' => 'Official Review', 
            'result' => 'Project Result',
            'RESULT_EFFICIENCY' => '40% efficiency growth',
            'RESULT_STABILITY' => 'Sustainable business growth',
            'RESULT_RISKS' => 'Business risk minimization',
            'DIRECTOR_TICRO' => 'Director of ‘TICRO’',
            'DIRECTOR_TOTAL' => 'Director of ‘Total Service’',
            'DIRECTOR_AMERICAN' => 'Director of ‘American School’',
            'TEXT_USMONOV' => 'Created a good working atmosphere, punctual, friendly, served tasty tea and of course gave practical advice. Thanks guys and good luck to you!',
            'TEXT_AMRIDINOVA' => 'Thank you for the long-term fruitful cooperation! It is a pleasure to deal with professionals — always fast, clear and to the point.',
            'TEXT_VEYN' => 'Guys, your service really matches your professionalism. I think the choice here is obvious. Thank you!',
            'NAME_USMONOV' => 'Fakhriddin Usmonov',
            'NAME_AMRIDINOVA' => 'Sayora Amridinova',
            'NAME_VEYN' => 'Cassidi Veyn'
        )
    );
    $l = isset($labels[$lang]) ? $labels[$lang] : $labels['ru'];

    $q = new WP_Query(array('post_type' => 'b2b_reviews', 'post_status' => 'publish', 'posts_per_page' => 15, 'orderby' => 'date', 'order' => 'DESC'));
    if (!$q->have_posts()) return '';

    ob_start(); ?>
    <div class="swiper b2b-swiper">
        <div class="swiper-wrapper">
            <?php while($q->have_posts()): $q->the_post(); 
                $title_raw = get_the_title();
                $company_raw = get_post_meta(get_the_ID(), '_b2b_company', true);
                $text_raw = get_post_meta(get_the_ID(), '_b2b_text', true);
                $result_raw = get_post_meta(get_the_ID(), '_b2b_result', true);
                
                // Dynamic translation of content
                $title = isset($l[$title_raw]) ? $l[$title_raw] : $title_raw;
                $company = isset($l[$company_raw]) ? $l[$company_raw] : $company_raw;
                $text = isset($l[$text_raw]) ? $l[$text_raw] : $text_raw;
                $result = isset($l[$result_raw]) ? $l[$result_raw] : $result_raw;
                
                // If empty, provide a fallback generic result
                if (empty($result)) $result = $l['RESULT_STABILITY'];

                // Skip empty or placeholder reviews
                if (empty(trim($text)) || empty(trim($title))) continue; 
            ?>
            <div class="swiper-slide">
                <div class="b2b-glass-card">
                    <div class="b2b-card-glow"></div>
                    <div class="b2b-quote-icon">“</div>
                    <div class="b2b-card-header">
                        <span class="b2b-badge"><?php echo esc_html($l['verified']); ?></span>
                    </div>
                    <div class="b2b-card-body">
                        <p class="b2b-text"><?php echo esc_html($text); ?></p>
                        <div class="b2b-result-box">
                            <span class="b2b-result-label"><?php echo esc_html($l['result']); ?>:</span>
                            <span class="b2b-result-value"><?php echo esc_html($result); ?></span>
                        </div>
                    </div>
                    <div class="b2b-card-footer">
                        <div class="b2b-author">
                            <h4 class="b2b-author-name"><?php echo esc_html($title); ?></h4>
                            <p class="b2b-author-meta"><?php echo esc_html($company); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="b2b-pagination swiper-pagination"></div>
        <div class="b2b-nav-next swiper-button-next"></div>
        <div class="b2b-nav-prev swiper-button-prev"></div>
    </div>

    <style>
        .b2b-swiper { padding: 40px 20px 100px; position: relative; max-width: 1400px; margin: 0 auto; }
        .b2b-glass-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.8) 100%);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(228, 231, 236, 0.8);
            border-radius: 24px;
            padding: 45px;
            height: 100%;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(16, 24, 40, 0.03);
        }
        .b2b-glass-card:hover {
            transform: translateY(-12px);
            background: #fff;
            box-shadow: 0 40px 80px rgba(16, 24, 40, 0.08);
            border-color: rgba(0, 68, 204, 0.2);
        }
        .b2b-card-glow {
            position: absolute;
            top: -20%; right: -20%; width: 50%; height: 50%;
            background: radial-gradient(circle at center, rgba(227, 6, 19, 0.05) 0%, transparent 70%);
            pointer-events: none;
            opacity: 0.3;
            transition: all 0.5s ease;
        }
        .b2b-glass-card:hover .b2b-card-glow { 
            opacity: 0.8; 
            background: radial-gradient(circle at center, rgba(0, 68, 204, 0.05) 0%, transparent 70%);
            transform: scale(1.5); 
        }
        .b2b-quote-icon {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 120px;
            line-height: 1;
            font-family: 'Noto Serif', serif;
            color: #E30613;
            opacity: 0.03;
            pointer-events: none;
        }
        .b2b-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: rgba(39, 174, 96, 0.05);
            color: #27ae60;
            border-radius: 100px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 30px;
            border: 1px solid rgba(39, 174, 96, 0.1);
        }
        .b2b-badge::before { content: '✓'; font-size: 12px; }
        .b2b-card-body { flex-grow: 1; margin-bottom: 35px; }
        .b2b-text {
            font-size: 16px;
            line-height: 1.8;
            color: #1D2939;
            font-style: italic;
            margin-bottom: 25px;
            position: relative;
            font-weight: 400;
        }
        .b2b-result-box {
            background: linear-gradient(90deg, rgba(0, 68, 204, 0.03) 0%, transparent 100%);
            border-left: 3px solid #0044CC;
            padding: 14px 20px;
            border-radius: 4px 16px 16px 4px;
        }
        .b2b-result-label { font-size: 11px; text-transform: uppercase; color: #8892A4; display: block; margin-bottom: 4px; font-weight: 700; }
        .b2b-result-value { font-size: 15px; font-weight: 800; color: #0044CC; }
        .b2b-card-footer { border-top: 1px solid rgba(16, 24, 40, 0.05); padding-top: 25px; }
        .b2b-author-name { font-family: 'Noto Serif', serif; font-size: 19px; font-weight: 800; color: #101828; margin: 0 0 5px 0; }
        .b2b-author-meta { font-size: 13px; color: #4B5468; margin: 0; font-weight: 500; }
        
        .swiper-button-next, .swiper-button-prev {
            width: 50px; height: 50px;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 10px 25px rgba(16, 24, 40, 0.08);
            color: #0044CC !important;
            transition: all 0.3s ease;
        }
        .swiper-button-next:hover, .swiper-button-prev:hover {
            background: #0044CC;
            color: #fff !important;
            transform: scale(1.1);
        }
        .swiper-button-next:after, .swiper-button-prev:after { font-size: 18px; font-weight: 900; }
        .swiper-pagination-bullet { width: 8px; height: 8px; background: #C8CDD6; opacity: 1; transition: all 0.3s ease; }
        .swiper-pagination-bullet-active { background: #E30613 !important; width: 24px; border-radius: 4px; }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiperContainer = document.querySelector('.b2b-swiper');
        if (swiperContainer && typeof Swiper !== 'undefined') {
            const slidesCount = swiperContainer.querySelectorAll('.swiper-slide').length;
            new Swiper('.b2b-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: slidesCount > 3,
                autoplay: { delay: 6000, disableOnInteraction: false },
                pagination: { el: '.swiper-pagination', clickable: true },
                navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1200: { slidesPerView: 3 }
                }
            });
        }
    });
    </script>
    <?php return ob_get_clean();
}
add_shortcode('b2b_carousel', 'neksoz_b2b_carousel_shortcode');
