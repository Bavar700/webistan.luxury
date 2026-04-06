<?php
/**
 * Script to auto-fix duplicate keys in translations.php
 * Keeps only the LAST occurrence of each duplicate key (most complete translation)
 */

$file = 'C:/Users/alaco/Academy_Webistan/yaghnob-heritage-v3/inc/translations.php';
$content = file_get_contents($file);

// Find all top-level keys and their positions
// Pattern: 'key_name' => array(
$pattern = "/(\n\s{8}'([a-z_0-9]+)'\s*=>\s*array\(.*?\),)/s";
preg_match_all($pattern, $content, $matches, PREG_OFFSET_CAPTURE);

$keys_seen = [];
$to_remove = [];

foreach ($matches[0] as $index => $match) {
    $full_match = $match[0];
    $offset = $match[1];
    $key_name = $matches[2][$index][0];

    if (isset($keys_seen[$key_name])) {
        // Mark the FIRST one for removal
        $to_remove[] = $keys_seen[$key_name];
    }
    $keys_seen[$key_name] = ['text' => $full_match, 'offset' => $offset];
}

if (empty($to_remove)) {
    echo "No duplicates to remove!\n";
    exit;
}

echo "Removing " . count($to_remove) . " duplicate entries:\n";

// Remove from end to start to preserve offsets
usort($to_remove, function($a, $b) { return $b['offset'] - $a['offset']; });

foreach ($to_remove as $item) {
    $text = $item['text'];
    $pos = strpos($content, $text);
    if ($pos !== false) {
        $content = substr($content, 0, $pos) . substr($content, $pos + strlen($text));
        echo "  Removed duplicate at position $pos\n";
    }
}

file_put_contents($file, $content);
echo "Done! File saved.\n";
