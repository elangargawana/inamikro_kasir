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
        Schema::create('merchant_toko', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id');
            $table->string('nama_toko');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('rt');
            $table->string('rw');
            $table->string('kode_pos');
            $table->string('alamat');
            $table->unsignedBigInteger('jenis_usaha_id');
            $table->unsignedBigInteger('kategori_usaha_id');
            $table->string('omset');
            $table->string('lokasi_usaha');
            $table->string('lokasi_usaha_lain');
            $table->string('media_sosial');
            $table->string('pajak_umkm')->nullable();
            $table->string('biaya_admin')->nullable();
            $table->string('is_qris');
            $table->string('is_nib');
            $table->string('is_spdm');
            $table->string('is_halal');
            $table->string('is_haki');
            $table->timestamps();

            $table->foreign('merchant_id')->references('id')->on('user_merchant')->cascadeOnDelete();
            $table->foreign('jenis_usaha_id')->references('id')->on('m_jenis_usaha')->cascadeOnDelete();
            $table->foreign('kategori_usaha_id')->references('id')->on('m_kategori_usaha')->cascadeOnDelete();
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
