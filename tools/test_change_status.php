<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Pendaftaran;
use App\Models\User;
use App\Http\Controllers\Admin\PendaftaranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

echo "=== Test changeStatus script ===\n";

$pendaftaran = Pendaftaran::first();
if (!$pendaftaran) {
    echo "No pendaftaran records found.\n";
    exit(1);
}

echo "Found pendaftaran id=" . $pendaftaran->id_pendaftaran . " status=" . ($pendaftaran->status_pendaftaran ?? 'NULL') . "\n";

// find admin or super_admin
$admin = User::where('role', 'super_admin')->first() ?: User::where('role', 'admin')->first();
if (!$admin) {
    // Try to find any user and update role to super_admin temporarily
    $admin = User::first();
    if ($admin) {
        $oldRole = $admin->role;
        $admin->role = 'super_admin';
        $admin->save();
        echo "Temporarily updated user id=" . $admin->id . " role to super_admin (was: " . $oldRole . ")\n";
    } else {
        echo "No users found at all.\n";
        exit(1);
    }
}

Auth::login($admin);
echo "Logged in as user id=" . $admin->id . " role=" . $admin->role . "\n";

// prepare request to change status
$targetId = $pendaftaran->id_pendaftaran;
$payload = [
    'status' => 'accepted',
    'interview_date' => null,
    'notes' => 'Automated test changeStatus'
];

$request = Request::create("/admin/pendaftaran/{$targetId}/status", 'POST', $payload);
$request->setUserResolver(function() use ($admin) { return $admin; });

// call controller
$controller = new PendaftaranController();

try {
    $before = Pendaftaran::find($targetId);
    echo "Before: status=" . ($before->status_pendaftaran ?? 'NULL') . " validated_at=" . ($before->validated_at ?? 'NULL') . "\n";

    $response = $controller->changeStatus($request, $targetId);

    // If response is JsonResponse
    if (method_exists($response, 'getContent')) {
        echo "Response: " . $response->getContent() . "\n";
    } else {
        echo "Response: (non-JSON) ";
        if (is_string($response)) echo $response . "\n";
        else print_r($response);
    }

    $after = Pendaftaran::find($targetId);
    echo "After: status=" . ($after->status_pendaftaran ?? 'NULL') . " validated_at=" . ($after->validated_at ?? 'NULL') . " notes=" . ($after->notes ?? 'NULL') . "\n";

} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}

// Additional check: try direct assignment and save to verify DB write works
echo "\nAttempting direct update via Eloquent...\n";
$p = Pendaftaran::find($targetId);
$p->status_pendaftaran = 'accepted';
$p->notes = 'Direct update test';
try {
    $ok = $p->save();
    echo "Direct save returned: " . ($ok ? 'true' : 'false') . "\n";
    $p2 = Pendaftaran::find($targetId);
    echo "After direct save: status=" . ($p2->status_pendaftaran ?? 'NULL') . " notes=" . ($p2->notes ?? 'NULL') . "\n";
} catch (\Exception $e) {
    echo "Direct save exception: " . $e->getMessage() . "\n";
}

echo "=== End ===\n";
