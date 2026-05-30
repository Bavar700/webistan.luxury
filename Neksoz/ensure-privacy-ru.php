<?php
require_once('wp-load.php');
$slug = 'privacy-policy';
$p = get_page_by_path($slug);
if ($p) {
    echo "Found page with slug '$slug': ID " . $p->ID . " | Title: " . $p->post_title . "\n";
} else {
    echo "Page with slug '$slug' NOT FOUND. Creating it now...\n";
    $page_id = wp_insert_post(array(
        'post_title'     => 'Политика конфиденциальности',
        'post_name'      => $slug,
        'post_content'   => 'Контент политики конфиденциальности...',
        'post_status'    => 'publish',
        'post_type'      => 'page',
        'post_author'    => 1,
    ));
    if ($page_id) {
        update_post_meta($page_id, '_wp_page_template', 'page-privacy.php');
        echo "Successfully created Russian Privacy Policy page (ID: $page_id).\n";
    } else {
        echo "Error creating page.\n";
    }
}
