<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::where('email', 'hr@company.com')->first();
echo "Roles: " . $user->getRoleNames() . PHP_EOL;
echo "Permissions: " . $user->getAllPermissions()->pluck('name') . PHP_EOL;

$package = $user->permissionPackage;
echo "Package: " . ($package ? $package->name : 'None') . PHP_EOL;
