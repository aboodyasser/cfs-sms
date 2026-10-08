<?php
$ar = json_decode(file_get_contents('resources/lang/ar.json'), true);
$keys = [];
foreach ($ar as $k => $v) {
    if ($k === $v && preg_match('/[a-zA-Z]/', $k)) {
        $keys[] = $k;
    }
}
file_put_contents('english_keys.json', json_encode($keys, JSON_PRETTY_PRINT));
echo count($keys) . " keys need translation.\n";
