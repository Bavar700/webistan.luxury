<?php
require_once('wp-load.php');
$ids = [3, 65, 66];
foreach($ids as $id) {
    $p = get_post($id);
    if($p) {
        echo "--- ID: $id ($p->post_title) ---\n";
        echo substr(strip_tags($p->post_content), 0, 200) . "...\n\n";
    }
}
