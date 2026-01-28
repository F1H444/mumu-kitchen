<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('kategoris')->where('nama_kategori', 'Main Course')->update(['nama_kategori' => 'Makanan Berat']);
        DB::table('kategoris')->where('nama_kategori', 'Beverage')->update(['nama_kategori' => 'Minuman']);
        DB::table('kategoris')->where('nama_kategori', 'Snacks')->update(['nama_kategori' => 'Snack']);

        // Also handling partial matches/case insensitive just in case
        DB::table('kategoris')->where('nama_kategori', 'like', 'Main Course%')->update(['nama_kategori' => 'Makanan Berat']);
        DB::table('kategoris')->where('nama_kategori', 'like', 'Beverage%')->update(['nama_kategori' => 'Minuman']);
        DB::table('kategoris')->where('nama_kategori', 'like', 'Snack%')->update(['nama_kategori' => 'Snack']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('kategoris')->where('nama_kategori', 'Makanan Berat')->update(['nama_kategori' => 'Main Course']);
        DB::table('kategoris')->where('nama_kategori', 'Minuman')->update(['nama_kategori' => 'Beverage']);
        DB::table('kategoris')->where('nama_kategori', 'Snack')->update(['nama_kategori' => 'Snacks']);
    }
};
