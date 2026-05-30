<?php
require_once('wp-load.php');
$pages = get_posts(array('post_type' => 'page', 'posts_per_page' => -1));
foreach($pages as $p) {
    echo $p->post_name . " (ID: " . $p->ID . ")\n";
}
unlink(__FILE__);
