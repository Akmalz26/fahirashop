<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_kasir');
            $table->date('tgl');
            $table->integer('jumlah');

            $table->foreign('id_produk')->references('id')->on('produks');
            $table->foreign('id_pelanggan')->references('id')->on('pelanggans');
            $table->foreign('id_kasir')->references('id')->on('kasirs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
