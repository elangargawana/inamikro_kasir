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
        Schema::create('trx_transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id');
            $table->string('invoice_number')->unique();
            $table->unsignedBigInteger('pelanggan_id')->nullable();
            $table->unsignedBigInteger('metode_bayar_id');
            $table->string('total');
            $table->string('total_bayar');
            $table->enum('jenis_transaksi', ['cepat', 'pintar']);
            $table->timestamps();

            $table->foreign('merchant_id')->references('id')->on('user_merchant')->cascadeOnDelete();
            $table->foreign('pelanggan_id')->references('id')->on('m_pelanggan')->cascadeOnDelete();
            $table->foreign('metode_bayar_id')->references('id')->on('m_metode_bayar')->cascadeOnDelete();
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
