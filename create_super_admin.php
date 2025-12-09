<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$email = 'admin@local.test';
$password = 'password';
$name = 'Super Admin';

$user = User::where('email', $email)->first();
if ($user) {
    echo "User already exists: {$user->email} (role: {$user->role})\n";
} else {
    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'role' => 'super_admin'
    ]);
    echo "Created user: {$user->email} with password '{$password}'\n";
}
