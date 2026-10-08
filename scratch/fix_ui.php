<?php

$viewsDir = __DIR__ . '/../resources/views/admin';

$targets = ['contracts', 'budgets', 'expenses', 'incomes', 'invoices', 'payments', 'receipts'];

// Extract UI from projects/create.blade.php
$projectCreateHtml = file_get_contents($viewsDir . '/projects/create.blade.php');
preg_match('/\{\{-- ========================================== --\}\}\s*\{\{-- Project Documents & Files \(Dynamic Add More\) --\}\}.*?<\/section>/s', $projectCreateHtml, $matches);
$uiBlock = $matches[0] ?? '';
$uiBlock = str_replace('{{ __(\'Project Documents\') }}', '{{ __(\'Documents & Attachments\') }}', $uiBlock);

foreach ($targets as $folder) {
    $viewPath = $viewsDir . '/' . $folder . '/create.blade.php';
    if (file_exists($viewPath)) {
        $content = file_get_contents($viewPath);

        if (strpos($content, 'Documents & Attachments') === false) {
            // We need to inject the HTML block right before the closing </form> or the actions div.
            // Let's find <div class="flex justify-end or <div class="flex flex-col-reverse
            $pattern = '/(<div[^>]*class="[^"]*(flex justify-end|flex flex-col-reverse)[^>]*>)/';
            if (preg_match($pattern, $content)) {
                $content = preg_replace($pattern, $uiBlock . "\n\n            $1", $content);
                file_put_contents($viewPath, $content);
                echo "Injected UI to $folder\n";
            } else {
                // Try to inject before </form>
                $content = preg_replace('/(<\/form>)/i', $uiBlock . "\n\n        $1", $content);
                file_put_contents($viewPath, $content);
                echo "Injected UI to $folder (before </form>)\n";
            }
        }
    }
}
