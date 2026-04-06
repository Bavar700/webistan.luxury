<?php
$content = file_get_contents('C:/Users/alaco/Academy_Webistan/yaghnob-heritage-v3/inc/translations.php');
preg_match_all("/'([a-z_0-9]+)'\s*=>/", $content, $matches);
$keys = $matches[1];
$counts = array_count_values($keys);
$found = false;
foreach ($counts as $key => $count) {
    if ($count > 1) {
        echo "DUPLICATE: '$key' found $count times\n";
        $found = true;
    }
}
if (!$found) echo "No duplicates found!\n";
echo "Done.\n";
