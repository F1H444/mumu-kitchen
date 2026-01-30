<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop foreign keys first
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->dropForeign(['ukuran_produk_id']);
            $table->dropColumn('ukuran_produk_id');
        });
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropForeign(['ukuran_produk_id']);
            $table->dropColumn('ukuran_produk_id');
        });

        // Drop tables
        Schema::dropIfExists('ukuran_produks');
        Schema::dropIfExists('ukurans');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Re-creating tables if needed (not strictly required for cleanup but good practice)
        Schema::create('ukurans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('jenis_ukuran');
            $table->timestamps();
        });
        Schema::create('ukuran_produks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->integer('stock');
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('ukuran_id');
            $table->timestamps();
        });
        Schema::table('keranjangs', function (Blueprint $table) {
            $table->unsignedBigInteger('ukuran_produk_id')->nullable();
        });
        Schema::table('pesanans', function (Blueprint $table) {
            $table->unsignedBigInteger('ukuran_produk_id')->nullable();
        });
    }
};
