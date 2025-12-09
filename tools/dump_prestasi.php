<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$nim = $argv[1] ?? '2401301022';
$p = App\Models\Prestasi::where('nim', $nim)->first();
echo "=== PRESTASI (nim={$nim}) ===\n";
if ($p) {
    echo json_encode($p->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    // also show loaded relation if present
    if ($p->relationLoaded('user') && $p->user) {
        echo "--- relation user (loaded) ---\n";
        echo json_encode(is_object($p->user) ? (array) $p->user : $p->user, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    }
} else {
    echo "NOT FOUND\n";
}

$m = App\Models\Mahasiswa::where('nim', $nim)->first();
echo "\n=== MAHASISWA (nim={$nim}) ===\n";
if ($m) {
    echo json_encode($m->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
} else {
    echo "NOT FOUND\n";
}
