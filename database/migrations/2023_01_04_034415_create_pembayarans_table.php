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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->string('snap_token', 36)->nullable();
            $table->enum('payment_status', ['belumbayar', 'sudahbayar', 'kadaluarsa', 'batal'])->default('belumbayar');
            $table->enum('status', ['menunggupembayaran', 'pesananditerima', 'pesanandiproses', 'pesanandikirim', 'pesananselesai', 'pesananbatal'])->default('menunggupembayaran');


            $table->string('no_invoice');
            $table->string('no_pemesanan')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('catatan')->nullable();
            $table->double('harga')->default(0);

            $table->foreignId('user_id')->references('id')->on('users')
                ->onDelete('restrict');

            $table->foreignId('pengiriman_id')->nullable()->references('id')->on('pengirimans')
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
        Schema::dropIfExists('pembayarans');
    }
};
