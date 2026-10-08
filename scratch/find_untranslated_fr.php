<?php

$files = glob(__DIR__ . '/../resources/views/admin/financial-reports/*.blade.php');

foreach ($files as $f) {
    $content = file_get_contents($f);
    $basename = basename($f);

    if (str_contains($content, '->format(')) {
        echo "$basename has Carbon ->format()\n";
    }
    if (preg_match("/[^\_]\(\s*\\\$[a-zA-Z0-9_\-\>\?\s]+\-\>name/", $content)) {
        echo "$basename has un-translated ->name\n";
    }
}
