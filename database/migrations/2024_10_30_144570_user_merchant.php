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
        Schema::create('user_merchant', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama_ibu')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->enum('gender', ['laki-laki', 'perempuan'])->nullable();
            $table->enum('agama', ['islam', 'kristen', 'katolik', 'hindu', 'budha', 'lainnya'])->nullable();
            $table->enum('status_kawin', ['kawin', 'belum_kawin'])->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('alamat')->nullable();
            $table->decimal('saldo', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
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
