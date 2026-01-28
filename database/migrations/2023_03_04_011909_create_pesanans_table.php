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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();
            $table->integer('kuantitas');
            $table->double('sub_total');

            $table->foreignid('pembayaran_id')->references('id')->on('pembayarans')
                ->onDelete('cascade');

            $table->foreignid('produk_id')->references('id')->on('produks')
                ->onDelete('cascade');

            $table->foreignid('ukuran_produk_id')->references('id')->on('ukuran_produks')
                ->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
};
