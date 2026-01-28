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
        DB::table('kategoris')->where('nama_kategori', 'Signature')->update(['nama_kategori' => 'Minuman']);
        DB::table('kategoris')->where('nama_kategori', 'Catering Box')->update(['nama_kategori' => 'Snack']);

        // Handle variations just in case
        DB::table('kategoris')->where('nama_kategori', 'like', 'Signature%')->update(['nama_kategori' => 'Minuman']);
        DB::table('kategoris')->where('nama_kategori', 'like', 'Catering Box%')->update(['nama_kategori' => 'Snack']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No strict reverse as we don't want to revert valid names back to "Signature" necessarily, 
        // but for completeness we could try, but it's ambiguous. We'll leave it empty or best effort.
    }
};
