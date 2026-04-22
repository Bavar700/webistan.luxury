<?php
require_once('wp-load.php');
$posts = get_posts(array('post_type' => 'post', 'posts_per_page' => -1));
echo "TOTAL POSTS: " . count($posts) . "\n";
foreach ($posts as $p) {
    echo "ID: " . $p->ID . " | TITLE: " . $p->post_title . "\n";
}
?>
