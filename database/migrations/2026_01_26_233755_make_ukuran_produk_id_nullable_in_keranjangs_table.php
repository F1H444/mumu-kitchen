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
        Schema::table('keranjangs', function (Blueprint $table) {
            // Drop foreign key first to be safe, then modify column, then re-add
            // However, many environments might not support dropping FKs by name easily without knowing the name.
            // We'll try the direct SQL if change() is not supported without doctrine/dbal.
        });

        DB::statement('ALTER TABLE keranjangs MODIFY ukuran_produk_id BIGINT UNSIGNED NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE keranjangs MODIFY ukuran_produk_id BIGINT UNSIGNED NOT NULL');
    }
};
