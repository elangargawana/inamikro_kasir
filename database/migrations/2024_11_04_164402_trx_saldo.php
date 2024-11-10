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
        Schema::create('trx_saldo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id');
            $table->enum('jenis', ['saldo_masuk', 'saldo_keluar']);
            $table->unsignedBigInteger('transaksi_id')->nullable();
            $table->unsignedBigInteger('penarikan_id')->nullable();
            $table->string('nominal');
            $table->string('saldo_awal');
            $table->string('saldo_akhir');
            $table->timestamps();

            $table->foreign('merchant_id')->references('id')->on('user_merchant')->cascadeOnDelete();
            $table->foreign('transaksi_id')->references('id')->on('trx_transaksi')->cascadeOnDelete();
            $table->foreign('penarikan_id')->references('id')->on('trx_penarikan')->cascadeOnDelete();
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
