<?php
/*
Plugin Name: Neksoz B2B Reviews System
Plugin URI: https://neksoz.tj
Description: Автономная система B2B-отзывов. Исправлены кнопки и конфликты JS.
Version: 2.7
Author: Senior Web Developer
*/

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * 1. Регистрация CPT
 */
function neksoz_b2b_register_cpt() {
    register_post_type('b2b_reviews', array(
        'labels' => array('name' => 'B2B Отзывы', 'singular_name' => 'Отзыв'),
        'public' => true, 'show_ui' => true, 'menu_icon' => 'dashicons-awards', 'supports' => array('title'), 'show_in_rest' => true,
    ));
}
add_action('init', 'neksoz_b2b_register_cpt');

/**
 * Принудительное обновление ссылок при активации
 */
register_activation_hook(__FILE__, 'neksoz_b2b_flush_rules');
function neksoz_b2b_flush_rules() {
    neksoz_b2b_register_cpt();
    flush_rewrite_rules();
    
    // Auto-seed initial reviews if the database is empty
    $existing = get_posts(array('post_type' => 'b2b_reviews', 'numberposts' => 1, 'post_status' => 'publish'));
    if (empty($existing)) {
        $reviews = array(
            array('title' => 'NAME_AMRIDINOVA', 'company' => 'DIRECTOR_AMERICAN', 'text' => 'TEXT_AMRIDINOVA', 'result' => 'RESULT_EFFICIENCY'),
            array('title' => 'NAME_VEYN', 'company' => 'DIRECTOR_TOTAL', 'text' => 'TEXT_VEYN', 'result' => 'RESULT_RISKS'),
            array('title' => 'NAME_USMONOV', 'company' => 'DIRECTOR_TICRO', 'text' => 'TEXT_USMONOV', 'result' => 'RESULT_STABILITY')
        );
        foreach ($reviews as $r) {
            $post_id = wp_insert_post(array(
                'post_title' => $r['title'],
                'post_type' => 'b2b_reviews',
                'post_status' => 'publish'
            ));
            if ($post_id) {
                update_post_meta($post_id, '_b2b_company', $r['company']);
                update_post_meta($post_id, '_b2b_text', $r['text']);
                update_post_meta($post_id, '_b2b_result', $r['result']);
            }
        }
    }
}

/**
 * 2. Метабоксы
 */
function neksoz_b2b_add_metaboxes() {
    add_meta_box('b2b_details', 'Детали отзыва', 'neksoz_b2b_render_metabox', 'b2b_reviews', 'normal', 'high');
}
add_action('add_meta_boxes', 'neksoz_b2b_add_metaboxes');

function neksoz_b2b_render_metabox($post) {
    wp_nonce_field('b2b_save', 'b2b_nonce');
    $fields = array('_b2b_company' => 'Компания','_b2b_result' => 'Результат','_b2b_text' => 'Текст');
    foreach ($fields as $key => $label) {
        $val = get_post_meta($post->ID, $key, true);
        echo '<p><strong>'.$label.':</strong><br>';
        if ($key === '_b2b_text') echo '<textarea name="'.$key.'" style="width:100%" rows="4">'.esc_textarea($val).'</textarea>';
        else echo '<input type="text" name="'.$key.'" value="'.esc_attr($val).'" style="width:100%">';
        echo '</p>';
    }
}

function neksoz_b2b_save_meta($post_id) {
    if (!isset($_POST['b2b_nonce']) || !wp_verify_nonce($_POST['b2b_nonce'], 'b2b_save')) return;
    foreach (array('_b2b_company', '_b2b_result', '_b2b_text') as $key) {
        if (isset($_POST[$key])) update_post_meta($post_id, $key, sanitize_textarea_field($_POST[$key]));
    }
}
add_action('save_post', 'neksoz_b2b_save_meta');

/**
 * 3. Ассеты
 */
function neksoz_b2b_enqueue_assets() {
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'neksoz_b2b_enqueue_assets');

/**
 * 4. Шорткод [b2b_carousel]
 */
function neksoz_b2b_carousel_shortcode() {
    $lang = function_exists('nk_get_current_lang') ? nk_get_current_lang() : 'ru';
    
    $labels = array(
        'ru' => array(
            'verified' => 'Официальный отзыв', 'result' => 'Результат проекта', 'leave_btn' => 'Оставить отзыв',
            'form_title' => 'Поделитесь вашим мнением', 'form_submit' => 'Отправить отзыв', 'form_success' => 'Спасибо! Отзыв отправлен.',
            'f_name' => 'Ваше имя', 'f_company' => 'Компания / Должность', 'f_text' => 'Текст отзыва', 'f_result' => 'Достигнутый результат',
            'NAME_USMONOV' => 'Фахриддин Усмонов', 'DIRECTOR_TICRO' => 'Директор TICRO', 'TEXT_USMONOV' => 'Создали хорошую рабочую атмосферу, пунктуальны, дружелюбны, подали вкусный чай и конечно дали дельные советы.',
            'NAME_VEYN' => 'Кассиди Вейн', 'DIRECTOR_TOTAL' => 'Директор Total Service', 'TEXT_VEYN' => 'Ребята ваш сервис действительно соответсвует вашему профессионализму. Думаю здесь выбор очиведен.',
            'NAME_AMRIDINOVA' => 'Амридинова Сайёра', 'DIRECTOR_AMERICAN' => 'Директор American school', 'TEXT_AMRIDINOVA' => 'Благодарим за долговременное плодотворное сотрудничество! Приятно иметь дело с профессионалами своего дела.',
            'RESULT_EFFICIENCY' => 'Эффективное партнерство', 'RESULT_RISKS' => 'Минимизация рисков', 'RESULT_STABILITY' => 'Устойчивое развитие бизнеса'
        ),
        'tj' => array(
            'verified' => 'Назари расмӣ', 'result' => 'Натиҷаи лоиҳа', 'leave_btn' => 'Назари шумо',
            'form_title' => 'Лутфан, изҳори назар кунед', 'form_submit' => 'Ирсоли назар', 'form_success' => 'Ташаккур! Назари шумо қабул шуд.',
            'f_name' => 'Номи шумо', 'f_company' => 'Ширкат / Вазифа', 'f_text' => 'Матни назар', 'f_result' => 'Натиҷаи бадастомада',
            'NAME_USMONOV' => 'Фахриддин Усмонов', 'DIRECTOR_TICRO' => 'Директори TICRO', 'TEXT_USMONOV' => 'Фазои хуби корӣ фароҳам оварданд, дақиқкор ва дӯстонаанд, бо чойи хушмазза меҳмондорӣ карданд ва маслиҳатҳои муфид доданд.',
            'NAME_VEYN' => 'Кассиди Вейн', 'DIRECTOR_TOTAL' => 'Директори Total Service', 'TEXT_VEYN' => 'Бачаҳо, хидматрасонии шумо воқеан ба касбияти шумо мувофиқ аст. Фикр мекунам, дар ин ҷо интихоб равшан аст.',
            'NAME_AMRIDINOVA' => 'Амридинова Сайёра', 'DIRECTOR_AMERICAN' => 'Директори American school', 'TEXT_AMRIDINOVA' => 'Барои ҳамкории тӯлонии пурсамар ташаккур мегӯем! Ҳамкорӣ бо мутахассисони соҳаатон хеле гуворо аст.',
            'RESULT_EFFICIENCY' => 'Ҳамкории самаранок', 'RESULT_RISKS' => 'Коҳиши хатарҳо', 'RESULT_STABILITY' => 'Рушди устувори тиҷорат'
        ),
        'en' => array(
            'verified' => 'Official Review', 'result' => 'Project Result', 'leave_btn' => 'Your review',
            'form_title' => 'Share your opinion', 'form_submit' => 'Submit Review', 'form_success' => 'Thank you!',
            'f_name' => 'Your name', 'f_company' => 'Company / Position', 'f_text' => 'Review text', 'f_result' => 'Result achieved',
            'NAME_USMONOV' => 'Fakhriddin Usmonov', 'DIRECTOR_TICRO' => 'Director of TICRO', 'TEXT_USMONOV' => 'They created a good working atmosphere, are punctual, friendly, served delicious tea and gave practical advice.',
            'NAME_VEYN' => 'Cassidi Veyn', 'DIRECTOR_TOTAL' => 'Director of Total Service', 'TEXT_VEYN' => 'Guys, your service really matches your professionalism. I think the choice here is obvious.',
            'NAME_AMRIDINOVA' => 'Amridinova Sayora', 'DIRECTOR_AMERICAN' => 'Director of American school', 'TEXT_AMRIDINOVA' => 'Thank you for the long-term fruitful cooperation! It is a pleasure to deal with professionals in their field.',
            'RESULT_EFFICIENCY' => 'Effective Partnership', 'RESULT_RISKS' => 'Risk minimization', 'RESULT_STABILITY' => 'Sustainable business growth'
        )
    );
    $l = isset($labels[$lang]) ? $labels[$lang] : $labels['ru'];

    $q = new WP_Query(array('post_type' => 'b2b_reviews', 'post_status' => 'publish', 'posts_per_page' => 15, 'orderby' => 'date', 'order' => 'DESC'));
    
    ob_start(); ?>
    <div class="b2b-reviews-container">
        <div class="swiper b2b-swiper">
            <div class="swiper-wrapper">
                <?php if($q->have_posts()): while($q->have_posts()): $q->the_post(); 
                    $t_raw = get_the_title(); $c_raw = get_post_meta(get_the_ID(), '_b2b_company', true); $x_raw = get_post_meta(get_the_ID(), '_b2b_text', true); $r_raw = get_post_meta(get_the_ID(), '_b2b_result', true);
                    $title = isset($l[$t_raw]) ? $l[$t_raw] : $t_raw;
                    $company = isset($l[$c_raw]) ? $l[$c_raw] : $c_raw;
                    $text = isset($l[$x_raw]) ? $l[$x_raw] : $x_raw;
                    $result = isset($l[$r_raw]) ? $l[$r_raw] : $r_raw;
                    if(empty($result)) $result = $l['RESULT_STABILITY'];
                    if(empty($text)) continue;
                ?>
                <div class="swiper-slide">
                    <div class="b2b-card">
                        <div class="b2b-badge-row">
                            <span class="b2b-badge"><span class="b2b-check-icon">✓</span><?php echo esc_html($l['verified']); ?></span>
                        </div>
                        <div class="b2b-text-content"><?php echo nl2br(esc_html($text)); ?></div>
                        <div class="b2b-res-box">
                            <span class="b2b-res-label"><?php echo esc_html($l['result']); ?>:</span>
                            <span class="b2b-res-val"><?php echo esc_html($result); ?></span>
                        </div>
                        <div class="b2b-author-info">
                            <h4 class="b2b-name"><?php echo esc_html($title); ?></h4>
                            <p class="b2b-meta"><?php echo esc_html($company); ?></p>
                        </div>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <div class="b2b-action">
            <button class="btn btn--primary btn-animated" id="openReviewModal">
                <?php echo esc_html($l['leave_btn']); ?>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
            </button>
        </div>
    </div>

    <!-- Modal Form (Moved outside if possible, but keeping for now) -->
    <div id="b2bReviewModal" class="b2b-modal">
        <div class="b2b-modal-content">
            <span class="b2b-close">&times;</span>
            <h3 style="font-family:'Noto Serif',serif; margin-bottom:25px; text-align:center;"><?php echo esc_html($l['form_title']); ?></h3>
            <form id="b2bSubmitForm">
                <input type="text" name="c_name" placeholder="<?php echo esc_attr($l['f_name']); ?>" required style="width:100%; padding:12px; margin-bottom:12px; border:1px solid #ddd; border-radius:8px;">
                <input type="text" name="c_company" placeholder="<?php echo esc_attr($l['f_company']); ?>" required style="width:100%; padding:12px; margin-bottom:12px; border:1px solid #ddd; border-radius:8px;">
                <textarea name="c_text" placeholder="<?php echo esc_attr($l['f_text']); ?>" rows="4" required style="width:100%; padding:12px; margin-bottom:12px; border:1px solid #ddd; border-radius:8px;"></textarea>
                <input type="text" name="c_result" placeholder="<?php echo esc_attr($l['f_result']); ?>" style="width:100%; padding:12px; margin-bottom:12px; border:1px solid #ddd; border-radius:8px;">
                <input type="hidden" name="action" value="b2b_submit_review">
                <?php wp_nonce_field('b2b_n_a', 'b2b_n_f'); ?>
                <button type="submit" class="btn btn--primary btn-animated" style="width:100%; margin-top:10px;">
                    <span><?php echo esc_html($l['form_submit']); ?></span>
                    <svg class="btn__arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
                <div id="b2bStatus" style="margin-top:15px; text-align:center;"></div>
            </form>
        </div>
    </div>

    <style>
        .b2b-reviews-container { padding: 10px 0 40px; }
        .b2b-swiper { padding: 10px 20px 80px; position: relative; }
        .b2b-card {
            background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(24px) saturate(160%); -webkit-backdrop-filter: blur(24px) saturate(160%);
            border: 1px solid rgba(255, 255, 255, 0.4); border-radius: 32px;
            padding: 45px; height: 100%; display: flex; flex-direction: column;
            box-shadow: 0 20px 50px rgba(0,0,0,0.04), inset 0 0 20px rgba(255,255,255,0.5);
            text-align: left !important; user-select: text !important; -webkit-user-select: text !important;
            cursor: default; position: relative; z-index: 5; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .b2b-card:hover { transform: translateY(-8px); box-shadow: 0 30px 70px rgba(0,68,204,0.08); border-color: rgba(0,68,204,0.2); }
        .b2b-badge { background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%); color: #fff; padding: 6px 14px; border-radius: 100px; font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 30px; width: fit-content; display: flex; align-items: center; gap: 6px; box-shadow: 0 4px 12px rgba(39,174,96,0.2); }
        .b2b-check-icon { font-size: 12px; }
        @keyframes b2b-blink { 0%, 100% { opacity: 0.3; } 50% { opacity: 1; } }
        .b2b-text-content { font-size: 1.1rem; line-height: 1.7; color: #1D2939 !important; font-style: italic; margin-bottom: 25px; flex-grow: 1; pointer-events: auto !important; }
        .b2b-res-box { background: rgba(0,68,204,0.03); border: 1px solid rgba(0,68,204,0.1); padding: 16px 20px; margin-bottom: 30px; border-radius: 12px; }
        .b2b-res-label { font-size: 9px; text-transform: uppercase; color: #667085; font-weight: 800; display: block; margin-bottom: 4px; letter-spacing: 0.05em; }
        .b2b-res-val { font-family: 'Noto Serif', serif; font-size: 16px; font-weight: 700; color: #0044CC; }
        .b2b-author-info { border-top: 1px solid rgba(0,0,0,0.05); padding-top: 25px; }
        .b2b-name { font-family: 'Noto Serif', serif; font-size: 1.25rem; font-weight: 700; color: #1D2939; margin: 0 0 5px 0; }
        .b2b-meta { font-family: 'Montserrat', sans-serif; font-size: 0.95rem; color: #667085; margin: 0; font-weight: 500; }
        .b2b-action { text-align: center; }
        .b2b-modal { display: none; position: fixed; z-index: 10005; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,13,51,0.6); backdrop-filter: blur(10px); align-items: center; justify-content: center; }
        .b2b-modal-content { background: #fff; padding: 40px; border-radius: 20px; width: 100%; max-width: 450px; position: relative; }
        .b2b-close { position: absolute; right: 20px; top: 15px; font-size: 24px; cursor: pointer; }
        .swiper-button-next, .swiper-button-prev { color: #0044CC !important; }
        .swiper-pagination-bullet-active { background: #E30613 !important; }
    </style>

    <script>
    (function() {
        document.addEventListener('DOMContentLoaded', function() {
            try {
                const modal = document.getElementById('b2bReviewModal');
                const btn = document.getElementById('openReviewModal');
                const span = document.querySelector('.b2b-close');
                
                if (btn && modal) {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        modal.style.display = "flex";
                    });
                }
                
                if (span && modal) {
                    span.addEventListener('click', function() {
                        modal.style.display = "none";
                    });
                }
                
                window.addEventListener('click', function(e) {
                    if (modal && e.target == modal) {
                        modal.style.display = "none";
                    }
                });

                const form = document.getElementById('b2bSubmitForm');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const status = document.getElementById('b2bStatus');
                        const submitBtn = form.querySelector('button[type="submit"]');
                        submitBtn.disabled = true;
                        const formData = new FormData(form);
                        fetch('<?php echo admin_url('admin-ajax.php'); ?>', { method: 'POST', body: formData })
                        .then(r => r.json()).then(data => {
                            if (data.success) {
                                status.innerHTML = '<p style="color:#27ae60; font-weight:600;"><?php echo esc_js($l['form_success']); ?></p>';
                                form.reset();
                                setTimeout(() => { modal.style.display = "none"; status.innerHTML = ""; submitBtn.disabled = false; }, 3000);
                            }
                        }).catch(() => { submitBtn.disabled = false; });
                    });
                }

                if (typeof Swiper !== 'undefined') {
                    new Swiper('.b2b-swiper', {
                        slidesPerView: 1, spaceBetween: 30, loop: true, simulateTouch: false,
                        pagination: { el: '.swiper-pagination', clickable: true },
                        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                        breakpoints: { 768: { slidesPerView: 2 }, 1200: { slidesPerView: 3 } }
                    });
                }
            } catch (err) {
                console.error("B2B Reviews Error: ", err);
            }
        });
    })();
    </script>
    <?php return ob_get_clean();
}
add_shortcode('b2b_carousel', 'neksoz_b2b_carousel_shortcode');

// AJAX
add_action('wp_ajax_b2b_submit_review', 'nk_h_b2b_review');
add_action('wp_ajax_nopriv_b2b_submit_review', 'nk_h_b2b_review');
function nk_h_b2b_review() {
    check_ajax_referer('b2b_n_a', 'b2b_n_f');
    $post_id = wp_insert_post(array('post_title'=>sanitize_text_field($_POST['c_name']),'post_status'=>'pending','post_type'=>'b2b_reviews'));
    if($post_id) {
        update_post_meta($post_id, '_b2b_company', sanitize_text_field($_POST['c_company']));
        update_post_meta($post_id, '_b2b_text', sanitize_textarea_field($_POST['c_text']));
        update_post_meta($post_id, '_b2b_result', sanitize_text_field($_POST['c_result']));
        wp_send_json_success();
    } wp_send_json_error();
}
