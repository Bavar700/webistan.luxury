<?php
require_once('wp-load.php');
global $wpdb;
$slug = 'privacy-policy';
$results = $wpdb->get_results("SELECT ID, post_title, post_name, post_type, post_status FROM $wpdb->posts WHERE post_name = '$slug'");
foreach($results as $r) {
    echo "ID: $r->ID | Title: $r->post_title | Slug: $r->post_name | Type: $r->post_type | Status: $r->post_status\n";
}
