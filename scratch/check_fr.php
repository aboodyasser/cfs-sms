<?php

$ar = json_decode(file_get_contents(__DIR__ . '/../resources/lang/ar.json'), true);
$files = glob(__DIR__ . '/../resources/views/admin/financial-reports/*.blade.php');

$missing = [];
$hardcoded = [];

foreach ($files as $f) {
    $content = file_get_contents($f);
    $basename = basename($f);

    // Check __()
    preg_match_all("/__\(\s*['\"](.*?)['\"]\s*[\),]/s", $content, $m);
    foreach ($m[1] as $key) {
        if (!isset($ar[$key])) {
            $missing[$key][] = $basename;
        }
    }

    // Check potential hardcoded English strings inside html tags (not in __())
    preg_match_all("/>\s*([A-Za-z][A-Za-z0-9\s,\.\-\&\(\)\/]{3,})\s*</", $content, $h);
    foreach ($h[1] as $text) {
        $text = trim($text);
        if ($text !== 'CFS-SMS' && $text !== 'CFS Smart Management System' && !str_contains($text, '{{') && !str_contains($text, 'Chart')) {
            $hardcoded[] = "$basename: '$text'";
        }
    }
}

echo "=== Missing in ar.json ===\n";
print_r($missing);

echo "\n=== Potential Hardcoded English Texts ===\n";
print_r(array_unique($hardcoded));
