<?php
/**
 * Test Script untuk Google Login
 * Jalankan dengan: php test_google_login.php
 */

require_once 'vendor/autoload.php';

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

echo "=== TEST GOOGLE LOGIN ===\n\n";

// Test 1: Cek konfigurasi routes
echo "1. Testing Routes...\n";
$routes = app('router')->getRoutes();
$googleRoutes = [];
foreach ($routes as $route) {
    if (strpos($route->uri(), 'auth/google') !== false) {
        $googleRoutes[] = $route->uri() . ' -> ' . $route->getActionName();
    }
}

if (count($googleRoutes) >= 2) {
    echo "✓ Google routes ditemukan:\n";
    foreach ($googleRoutes as $route) {
        echo "  - $route\n";
    }
} else {
    echo "✗ Google routes tidak lengkap\n";
}

echo "\n";

// Test 2: Cek konfigurasi Socialite
echo "2. Testing Socialite Configuration...\n";
try {
    $googleConfig = config('services.google');
    if ($googleConfig && isset($googleConfig['client_id']) && isset($googleConfig['client_secret'])) {
        echo "✓ Google config ditemukan\n";
        echo "  - Client ID: " . (empty($googleConfig['client_id']) ? 'EMPTY' : 'SET') . "\n";
        echo "  - Client Secret: " . (empty($googleConfig['client_secret']) ? 'EMPTY' : 'SET') . "\n";
        echo "  - Redirect URI: " . ($googleConfig['redirect'] ?? 'NOT SET') . "\n";
    } else {
        echo "✗ Google config tidak lengkap\n";
    }
} catch (Exception $e) {
    echo "✗ Error checking config: " . $e->getMessage() . "\n";
}

echo "\n";

// Test 3: Cek User model
echo "3. Testing User Model...\n";
$user = new User();
$fillable = $user->getFillable();
if (in_array('role', $fillable)) {
    echo "✓ Role field ada di fillable\n";
} else {
    echo "✗ Role field tidak ada di fillable\n";
}

if (method_exists($user, 'isMahasiswa')) {
    echo "✓ isMahasiswa() method exists\n";
} else {
    echo "✗ isMahasiswa() method missing\n";
}

echo "\n";

// Test 4: Cek GoogleController
echo "4. Testing GoogleController...\n";
$controllerPath = app_path('Http/Controllers/GoogleController.php');
if (file_exists($controllerPath)) {
    echo "✓ GoogleController file exists\n";

    $content = file_get_contents($controllerPath);
    if (strpos($content, 'stateless()') === false) {
        echo "✓ stateless() method sudah dihapus\n";
    } else {
        echo "✗ stateless() method masih ada\n";
    }

    if (strpos($content, "'role' => 'mahasiswa'") !== false) {
        echo "✓ Role assignment untuk mahasiswa sudah ditambahkan\n";
    } else {
        echo "✗ Role assignment belum ditambahkan\n";
    }
} else {
    echo "✗ GoogleController file tidak ditemukan\n";
}

echo "\n";

// Test 5: Cek middleware dan auth
echo "5. Testing Authentication Setup...\n";
try {
    $authConfig = config('auth');
    if (isset($authConfig['guards']['web'])) {
        echo "✓ Web guard configured\n";
    } else {
        echo "✗ Web guard not configured\n";
    }
} catch (Exception $e) {
    echo "✗ Error checking auth config: " . $e->getMessage() . "\n";
}

echo "\n=== MANUAL TESTING REQUIRED ===\n";
echo "Untuk test lengkap, lakukan langkah berikut:\n";
echo "1. Jalankan aplikasi: php artisan serve\n";
echo "2. Buka http://localhost:8000/login\n";
echo "3. Klik 'Login dengan Google'\n";
echo "4. Pastikan redirect ke Google OAuth berhasil\n";
echo "5. Setelah login, cek database users table untuk role 'mahasiswa'\n";
echo "6. Akses /dashboard untuk memastikan login berhasil\n";

echo "\n=== TROUBLESHOOTING ===\n";
echo "Jika masih error 400:\n";
echo "- Pastikan GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET benar\n";
echo "- Pastikan GOOGLE_REDIRECT_URI sesuai dengan yang di Google Console\n";
echo "- Pastikan domain aplikasi terdaftar di Google Console\n";
echo "- Cek logs Laravel untuk error detail\n";

echo "\nTest selesai.\n";
?>
