<?php
$a = json_decode(file_get_contents('resources/lang/ar.json'), true);
$missing = [];
foreach ($a as $k => $v) {
    if ($k === $v && preg_match('/[a-zA-Z]/', $k)) {
        $missing[] = $k;
    }
}
file_put_contents('missing.json', json_encode(array_values($missing), JSON_PRETTY_PRINT));
echo count($missing);
