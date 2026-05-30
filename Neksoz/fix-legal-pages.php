<?php
require_once('wp-load.php');

// 1. Fix Russian Privacy Policy (ID 3)
$ru_privacy_id = 3;
wp_update_post(array(
    'ID'           => $ru_privacy_id,
    'post_title'   => 'Политика конфиденциальности',
    'post_name'    => 'privacy-policy',
    'post_content' => 'Содержимое политики конфиденциальности (RU)',
));
update_post_meta($ru_privacy_id, '_wp_page_template', 'page-privacy.php');
echo "Fixed ID 3: Set title to RU and template to page-privacy.php\n";

// 2. Fix Russian Terms of Use (Slug 'terms')
$terms_ru = get_page_by_path('terms');
if ($terms_ru) {
    wp_update_post(array(
        'ID'         => $terms_ru->ID,
        'post_title' => 'Условия использования',
    ));
    update_post_meta($terms_ru->ID, '_wp_page_template', 'page-terms.php');
    echo "Fixed Terms RU: ID " . $terms_ru->ID . "\n";
}

// 3. Verify EN versions
$en_privacy = get_page_by_path('privacy-policy-en');
if ($en_privacy) {
    update_post_meta($en_privacy->ID, '_wp_page_template', 'page-privacy-en.php');
    echo "Verified Privacy EN: ID " . $en_privacy->ID . "\n";
}

$en_terms = get_page_by_path('terms-en');
if ($en_terms) {
    update_post_meta($en_terms->ID, '_wp_page_template', 'page-terms-en.php');
    echo "Verified Terms EN: ID " . $en_terms->ID . "\n";
}

// 4. Verify TJ versions
$tj_privacy = get_page_by_path('privacy-policy-tj');
if ($tj_privacy) {
    update_post_meta($tj_privacy->ID, '_wp_page_template', 'page-privacy-tj.php');
    echo "Verified Privacy TJ: ID " . $tj_privacy->ID . "\n";
}

$tj_terms = get_page_by_path('terms-tj');
if ($tj_terms) {
    update_post_meta($tj_terms->ID, '_wp_page_template', 'page-terms-tj.php');
    echo "Verified Terms TJ: ID " . $tj_terms->ID . "\n";
}
