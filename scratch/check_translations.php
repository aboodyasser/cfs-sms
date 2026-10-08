<?php

$arJson = json_decode(file_get_contents(__DIR__ . '/../resources/lang/ar.json'), true);
$enJson = json_decode(file_get_contents(__DIR__ . '/../resources/lang/en.json'), true);

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/../resources/views'));

$missingAr = [];
$missingEn = [];
$allKeys = [];

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        
        preg_match_all("/__\(\s*['\"](.*?)['\"]\s*[\),]/", $content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key) {
                if (str_contains($key, '$') || empty(trim($key))) {
                    continue;
                }
                $allKeys[$key] = true;
                if (!array_key_exists($key, $arJson)) {
                    $missingAr[$key][] = str_replace(realpath(__DIR__ . '/..') . '\\', '', $file->getPathname());
                }
                if (!array_key_exists($key, $enJson)) {
                    $missingEn[$key][] = str_replace(realpath(__DIR__ . '/..') . '\\', '', $file->getPathname());
                }
            }
        }
    }
}

// Also scan Controllers
$controllerIter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/../app/Http/Controllers'));
foreach ($controllerIter as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        preg_match_all("/__\(\s*['\"](.*?)['\"]\s*[\),]/", $content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key) {
                if (str_contains($key, '$') || empty(trim($key))) {
                    continue;
                }
                $allKeys[$key] = true;
                if (!array_key_exists($key, $arJson)) {
                    $missingAr[$key][] = str_replace(realpath(__DIR__ . '/..') . '\\', '', $file->getPathname());
                }
                if (!array_key_exists($key, $enJson)) {
                    $missingEn[$key][] = str_replace(realpath(__DIR__ . '/..') . '\\', '', $file->getPathname());
                }
            }
        }
    }
}

echo "Total unique translation keys found: " . count($allKeys) . "\n\n";

echo "Missing in ar.json (" . count($missingAr) . "):\n";
foreach ($missingAr as $k => $files) {
    echo "  - '$k' (found in " . implode(', ', array_unique($files)) . ")\n";
}

echo "\nMissing in en.json (" . count($missingEn) . "):\n";
foreach ($missingEn as $k => $files) {
    echo "  - '$k' (found in " . implode(', ', array_unique($files)) . ")\n";
}
