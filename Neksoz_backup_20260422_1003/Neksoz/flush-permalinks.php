<?php
require_once('wp-load.php');
global $wp_rewrite;
$wp_rewrite->init();
$wp_rewrite->flush_rules();
echo "Permalinks flushed successfully!";
?>
