<?php

$viewsDir = __DIR__ . '/../resources/views/admin';
$controllersDir = __DIR__ . '/../app/Http/Controllers/Admin';
$requestsDir = __DIR__ . '/../app/Http/Requests/Admin';

$targets = [
    'contracts' => ['model' => 'Contract', 'var' => 'contract', 'controller' => 'ContractController', 'request' => 'StoreContractRequest'],
    'budgets' => ['model' => 'Budget', 'var' => 'budget', 'controller' => 'BudgetController', 'request' => 'StoreBudgetRequest'],
    'expenses' => ['model' => 'Expense', 'var' => 'expense', 'controller' => 'ExpenseController', 'request' => 'StoreExpenseRequest'],
    'incomes' => ['model' => 'Income', 'var' => 'income', 'controller' => 'IncomeController', 'request' => 'StoreIncomeRequest'],
    'invoices' => ['model' => 'Invoice', 'var' => 'invoice', 'controller' => 'InvoiceController', 'request' => 'StoreInvoiceRequest'],
    'payments' => ['model' => 'Payment', 'var' => 'payment', 'controller' => 'PaymentController', 'request' => 'StorePaymentRequest'],
    'projects' => ['model' => 'Project', 'var' => 'project', 'controller' => 'ProjectController', 'request' => 'StoreProjectRequest'],
    'receipts' => ['model' => 'Receipt', 'var' => 'receipt', 'controller' => 'ReceiptController', 'request' => 'StoreReceiptRequest'],
];

// Extract UI from projects/create.blade.php
$projectCreatePath = $viewsDir . '/projects/create.blade.php';
$projectCreateHtml = file_get_contents($projectCreatePath);

// Extract the documents block
preg_match('/\{\{-- ========================================== --\}\}\s*\{\{-- Project Documents & Files \(Dynamic Add More\) --\}\}.*?<\/section>/s', $projectCreateHtml, $matches);
$uiBlock = $matches[0] ?? '';
if (!$uiBlock) {
    die("Could not find UI block in projects/create.blade.php\n");
}
// Replace "Project Documents" with a generic one or use __('Documents')
$uiBlock = str_replace('{{ __(\'Project Documents\') }}', '{{ __(\'Documents & Attachments\') }}', $uiBlock);

// Extract JS block
preg_match('/<script>.*?<\/script>/s', $projectCreateHtml, $jsMatches);
$jsBlock = $jsMatches[0] ?? '';

foreach ($targets as $folder => $config) {
    echo "Processing $folder...\n";

    // 1. View: create.blade.php
    $viewPath = $viewsDir . '/' . $folder . '/create.blade.php';
    if (file_exists($viewPath)) {
        $viewContent = file_get_contents($viewPath);

        if (strpos($viewContent, 'name="documents') === false) {
            // Add enctype
            if (strpos($viewContent, 'enctype="multipart/form-data"') === false) {
                $viewContent = preg_replace('/(<form[^>]*?)(>)/i', '$1 enctype="multipart/form-data"$2', $viewContent);
            }

            // Insert UI before form actions
            $actionsPattern = '/\{\{-- ========================================== --\}\}\s*\{\{-- Form Actions --\}\}/s';
            if (preg_match($actionsPattern, $viewContent)) {
                $viewContent = preg_replace($actionsPattern, $uiBlock . "\n\n                " . '$0', $viewContent);
            }

            // Insert JS before @endsection
            if (strpos($viewContent, 'file_rows_container') === false && $jsBlock) {
                $viewContent = preg_replace('/@endsection/i', $jsBlock . "\n\n@endsection", $viewContent);
            }

            file_put_contents($viewPath, $viewContent);
            echo "  Updated View\n";
        }
    }

    // 2. Controller
    $controllerPath = $controllersDir . '/' . $config['controller'] . '.php';
    if (file_exists($controllerPath)) {
        $controllerContent = file_get_contents($controllerPath);
        $changed = false;

        if (strpos($controllerContent, 'use App\Traits\HandlesAttachments;') === false) {
            $controllerContent = preg_replace('/(use Illuminate\\\\Http\\\\Request;)/', "use App\\Traits\\HandlesAttachments;\n$1", $controllerContent);
            $controllerContent = preg_replace('/(class '.$config['controller'].' extends Controller\s*\{\s*)/', "$1use HandlesAttachments;\n\n    ", $controllerContent);
            $changed = true;
        }

        // Add handleAttachments call in store method
        // Look for creation: Model::create or $var = Model::create
        $createRegex = '/([\$a-zA-Z0-9_>]+) = ' . $config['model'] . '::create\((.*?)\);/s';
        if (preg_match($createRegex, $controllerContent, $m)) {
            $varName = $m[1];
            if (strpos($controllerContent, '->handleAttachments(') === false) {
                $replacement = $m[0] . "\n\n        \$this->handleAttachments(\$request, {$varName});";
                $controllerContent = str_replace($m[0], $replacement, $controllerContent);
                $changed = true;
            }
        } else {
            // Might be just Model::create
            $createRegex2 = '/' . $config['model'] . '::create\((.*?)\);/s';
            if (preg_match($createRegex2, $controllerContent, $m)) {
                if (strpos($controllerContent, '->handleAttachments(') === false) {
                    $replacement = '$' . $config['var'] . ' = ' . $m[0] . "\n\n        \$this->handleAttachments(\$request, \$" . $config['var'] . ");";
                    $controllerContent = str_replace($m[0], $replacement, $controllerContent);
                    $changed = true;
                }
            }
        }

        if ($changed) {
            file_put_contents($controllerPath, $controllerContent);
            echo "  Updated Controller\n";
        }
    }

    // 3. FormRequest
    $requestPath = $requestsDir . '/' . $config['request'] . '.php';
    if (file_exists($requestPath)) {
        $requestContent = file_get_contents($requestPath);
        if (strpos($requestContent, "'documents.*'") === false) {
            $rulesAdd = "\n            'documents' => ['nullable', 'array'],\n            'documents.*' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp,doc,docx', 'max:10240'],\n            'file_descriptions' => ['nullable', 'array'],\n            'file_descriptions.*' => ['nullable', 'string', 'max:255'],\n        ];";
            $requestContent = preg_replace('/];\s*\}\s*\}\s*$/', $rulesAdd . "\n    }\n}\n", $requestContent);
            file_put_contents($requestPath, $requestContent);
            echo "  Updated Request\n";
        }
    }
}
echo "Done.\n";
