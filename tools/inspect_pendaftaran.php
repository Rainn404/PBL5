<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Pendaftaran;

$p = Pendaftaran::with(['user','validator','divisi','jabatan'])->first();
if (!$p) {
    echo "NO RECORD\n";
    exit;
}

echo "id:" . $p->id_pendaftaran . "\n";
echo "status:" . ($p->status_pendaftaran ?? 'NULL') . "\n";
echo "interview_date:" . ($p->interview_date ?? 'NULL') . "\n";
echo "notes:" . ($p->notes ?? 'NULL') . "\n";
