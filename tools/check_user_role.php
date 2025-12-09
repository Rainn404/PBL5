<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// This checks all users and their roles
$users = \App\Models\User::all();

echo "=== All Users in Database ===\n";
foreach ($users as $user) {
    echo "ID: {$user->id}\n";
    echo "Name: {$user->name}\n";
    echo "Email: {$user->email}\n";
    echo "Role: '{$user->role}'\n";
    echo "Role (lowercase): '" . strtolower((string)$user->role) . "'\n";
    echo "isSuperAdmin(): " . ($user->isSuperAdmin() ? 'true' : 'false') . "\n";
    echo "isAdmin(): " . ($user->isAdmin() ? 'true' : 'false') . "\n";
    echo "isAdministrator(): " . ($user->isAdministrator() ? 'true' : 'false') . "\n";
    echo "---\n";
}
