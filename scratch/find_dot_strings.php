<?php

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/../resources/views'));

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        preg_match_all("/__\(\s*['\"]([A-Za-z0-9_]+\.[A-Za-z0-9_\s\.\-\/]+)['\"]\s*[\),]/", $content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key) {
                // Ignore welcome. prefix as we added those explicitly
                if (str_starts_with($key, 'welcome.')) {
                    continue;
                }
                echo str_replace(realpath(__DIR__ . '/..') . '\\', '', $file->getPathname()) . " => '$key'\n";
            }
        }
    }
}
