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
        Schema::create('tiket_konsers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_konser');
            $table->string('tanggal_konser');
            $table->string('jenis_tiket');
            $table->integer('harga_tiket');
            $table->integer('stok_tiket');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiket_konsers');
    }
};
