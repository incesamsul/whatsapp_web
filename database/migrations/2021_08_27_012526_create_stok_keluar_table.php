<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_keluar', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('barcode', 30);
            $table->string('nama_produk', 30);
            $table->string('jumlah', 30);
            $table->string('keterangan', 30);
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
        Schema::dropIfExists('stok_keluar');
    }
}
