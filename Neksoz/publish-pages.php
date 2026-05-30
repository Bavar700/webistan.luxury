<?php
require_once('wp-load.php');

// 1. Publish ID 3 (Russian Privacy Policy)
wp_update_post(array(
    'ID'          => 3,
    'post_status' => 'publish',
));
echo "Published ID 3 (RU Privacy).\n";

// 2. Publish ID 62 (Russian Terms)
wp_update_post(array(
    'ID'          => 62,
    'post_status' => 'publish',
));
echo "Published ID 62 (RU Terms).\n";

// 3. Flush Rewrite Rules
flush_rewrite_rules();
echo "Flushed rewrite rules.\n";
