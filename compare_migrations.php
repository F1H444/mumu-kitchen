<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$dbMigrations = DB::table('migrations')->pluck('migration')->toArray();
$files = scandir(__DIR__ . '/database/migrations');
$fileMigrations = [];
foreach ($files as $file) {
    if (str_ends_with($file, '.php')) {
        $fileMigrations[] = str_replace('.php', '', $file);
    }
}

echo "Migrations in DB but not in files:\n";
foreach (array_diff($dbMigrations, $fileMigrations) as $m) {
    echo "- $m\n";
}

echo "\nMigrations in files but not in DB:\n";
foreach (array_diff($fileMigrations, $dbMigrations) as $m) {
    echo "- $m\n";
}
