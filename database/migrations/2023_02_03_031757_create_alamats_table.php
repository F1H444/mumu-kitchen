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
        Schema::create('alamats', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();
            $table->string('nama_penerima');
            $table->string('kode_pos');
            $table->string('detail_alamat');
            $table->string('phone');
            $table->foreignid('user_id')->references('id')->on('users')
                ->onDelete('restrict');
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
        Schema::dropIfExists('alamats');
    }
};
