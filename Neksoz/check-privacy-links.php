<?php
require_once('wp-load.php');
$ids = [3, 65, 66];
foreach($ids as $id) {
    $p = get_post($id);
    if($p) {
        echo "ID: $id | Title: " . $p->post_title . " | Slug: " . $p->post_name . " | Permalink: " . get_permalink($id) . "\n";
    } else {
        echo "ID: $id NOT FOUND\n";
    }
}
$privacy_by_path = get_page_by_path('privacy-policy');
if($privacy_by_path) {
    echo "Page by path 'privacy-policy': ID " . $privacy_by_path->ID . " | Title: " . $privacy_by_path->post_title . "\n";
}
