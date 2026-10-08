<?php
$files = ['create.blade.php', 'edit.blade.php', 'index.blade.php', 'show.blade.php'];
foreach ($files as $f) {
    $p = 'resources/views/admin/users/' . $f;
    if (!file_exists($p)) continue;
    $c = file_get_contents($p);
    
    $replacements = [
        'Full Name',
        'Email',
        'Password',
        'Confirm Password',
        'Status',
        'Create User',
        'Edit User',
        'Cancel',
        'Save',
        'Update',
        'Role',
        'Department',
        'Position',
        'Permission Package',
        'Select a role',
        'Select a status',
        'Select a department',
        'Select a position',
        'Select a package',
        'Leave blank to keep current password',
    ];

    foreach ($replacements as $word) {
        $c = preg_replace('/(>)\s*'.preg_quote($word, '/').'\s*(<)/i', '$1{{ __(\''.$word.'\') }}$2', $c);
    }

    // Also replace hardcoded Create User in headers
    $c = preg_replace("/\bCreate User\b/i", "{{ __('Create User') }}", $c);
    $c = preg_replace("/\bEdit User\b/i", "{{ __('Edit User') }}", $c);

    file_put_contents($p, $c);
}
echo "Replaced hardcoded strings in users blade files.";
