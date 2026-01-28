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
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();
            $table->double('harga_ongkir');

            $table->string('no_hp');

            $table->string('nama_penerima');

            $table->string('alamat');

            $table->string('kode_pos');

            $table->string('nama_ekspedisi');

            $table->string('no_resi')->nullable();

            $table->string('paket_layanan');


            $table->foreignid('provinsi_id')->references('id')->on('provinsis')
                ->onDelete('restrict');

            $table->foreignid('kota_id')->references('id')->on('kotas')
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
        Schema::dropIfExists('pengirimen');
    }
};
