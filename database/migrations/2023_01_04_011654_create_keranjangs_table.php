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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            
            $table->uuid('uuid')->unique();
            $table->string('kuantitas');

            $table->foreignid('user_id')->references('id')->on('users')
                ->onDelete('restrict');

            $table->foreignid('produk_id')->references('id')->on('produks')
                ->onDelete('restrict');

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
        Schema::dropIfExists('keranjangs');
    }
};
