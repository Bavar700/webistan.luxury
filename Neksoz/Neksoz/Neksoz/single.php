<?php
/**
 * Single Post Router — Neksoz.Luxury
 * Strictly routes to isolated language templates.
 */

get_header();

$current_lang = 'ru';
if (isset($_GET['lang'])) {
    $current_lang = sanitize_text_field($_GET['lang']);
} elseif (is_single()) {
    $post_id = get_the_ID();
    if (has_term('tj', 'category', $post_id)) $current_lang = 'tj';
    elseif (has_term('en', 'category', $post_id)) $current_lang = 'en';
}

// Route to isolated language files
if ($current_lang === 'tj') {
    get_template_part('templates/single', 'tj');
} elseif ($current_lang === 'en') {
    get_template_part('templates/single', 'en');
} else {
    get_template_part('templates/single', 'ru');
}

get_footer();
