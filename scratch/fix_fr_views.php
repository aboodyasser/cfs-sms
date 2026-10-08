<?php

$files = glob(__DIR__ . '/../resources/views/admin/financial-reports/*.blade.php');

foreach ($files as $f) {
    $content = file_get_contents($f);
    $original = $content;

    // 1. Convert ->format('d M Y') or ->format('M d, Y') or ->format('Y-m-d') to localized format where month is named
    // e.g. ->format('d M Y') => ->locale(app()->getLocale())->translatedFormat('d M Y')
    $content = preg_replace(
        "/->format\(['\"]d M Y['\"]\)/",
        "->locale(app()->getLocale())->translatedFormat('d M Y')",
        $content
    );

    $content = preg_replace(
        "/->format\(['\"]M d, Y['\"]\)/",
        "->locale(app()->getLocale())->translatedFormat('d M Y')",
        $content
    );

    // 2. Fix un-translated department name in index.blade.php
    $content = str_replace(
        "{{ optional(\$project->department)->name ?? __('Unassigned') }}",
        "{{ __(\$project->department?->name ?? 'Unassigned') }}",
        $content
    );

    $content = str_replace(
        "{{ optional(\$project->department)->name ?? 'Unassigned' }}",
        "{{ __(\$project->department?->name ?? 'Unassigned') }}",
        $content
    );

    if ($content !== $original) {
        file_put_contents($f, $content);
        echo "Updated " . basename($f) . "\n";
    }
}
