<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Ukuran;
use App\Models\Produk;
use Illuminate\Support\Str;

$u1 = Ukuran::firstOrCreate(['jenis_ukuran' => 'Porsi Biasa'], ['uuid' => Str::uuid()]);
$u2 = Ukuran::firstOrCreate(['jenis_ukuran' => 'Porsi Besar'], ['uuid' => Str::uuid()]);

$produks = Produk::all();
foreach ($produks as $p) {
    // Check if pivot exists to avoid duplicates
    if (!$p->ukuran()->where('ukuran_id', $u1->id)->exists()) {
        $p->ukuran()->attach($u1->id, ['stock' => 100, 'uuid' => Str::uuid()]);
    }
    if (!$p->ukuran()->where('ukuran_id', $u2->id)->exists()) {
        $p->ukuran()->attach($u2->id, ['stock' => 50, 'uuid' => Str::uuid()]);
    }
}
echo "Seeding successful!\n";
