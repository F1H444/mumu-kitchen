<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$kategoris = App\Models\Kategori::all();
foreach ($kategoris as $k) {
    echo $k->nama_kategori . PHP_EOL;
}
