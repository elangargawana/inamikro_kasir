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
        Schema::create('trx_transaksi_cepat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->string('nama_produk');
            $table->string('harga_satuan');
            $table->string('kuantitas');
            $table->unsignedBigInteger('satuan_id');
            $table->string('total');
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id')->on('trx_transaksi')->cascadeOnDelete();
            $table->foreign('satuan_id')->references('id')->on('m_satuan')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
