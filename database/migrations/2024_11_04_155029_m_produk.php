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
        Schema::create('m_produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id');
            $table->unsignedBigInteger('kategori_produk_id');
            $table->string('code');
            $table->string('nama_produk');
            $table->unsignedBigInteger('satuan_id');
            $table->string('stok');
            $table->string('harga_jual');
            $table->string('harga_modal');
            $table->string('kadaluwarsa')->nullable();
            $table->timestamps();

            $table->foreign('merchant_id')->references('id')->on('user_merchant')->cascadeOnDelete();
            $table->foreign('kategori_produk_id')->references('id')->on('m_kategori_produk')->cascadeOnDelete();
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
