<?php
require_once('wp-load.php');
$pages = get_posts(array('post_type' => 'page', 'posts_per_page' => -1));
foreach($pages as $p) {
    echo "ID: " . $p->ID . " | Title: " . $p->post_title . " | Slug: " . $p->post_name . " | Template: " . get_post_meta($p->ID, '_wp_page_template', true) . "\n";
}
