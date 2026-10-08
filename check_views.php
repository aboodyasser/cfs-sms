<?php
$controllersPath = __DIR__ . '/app/Http/Controllers';
$viewsPath = __DIR__ . '/resources/views';

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($controllersPath));
$missingViews = [];

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        
        // Match view('view.name')
        preg_match_all("/view\(['\"]([^'\"]+)['\"]/i", $content, $matches);
        
        if (!empty($matches[1])) {
            foreach ($matches[1] as $viewName) {
                // Convert view.name to view/name.blade.php
                $viewFile = str_replace('.', '/', $viewName) . '.blade.php';
                $fullPath = $viewsPath . '/' . $viewFile;
                
                if (!file_exists($fullPath)) {
                    $missingViews[] = [
                        'controller' => $file->getFilename(),
                        'view' => $viewName,
                        'expected_path' => $viewFile
                    ];
                }
            }
        }
    }
}

if (empty($missingViews)) {
    echo "All referenced views exist!\n";
} else {
    echo "Missing Views Found:\n";
    print_r($missingViews);
}
