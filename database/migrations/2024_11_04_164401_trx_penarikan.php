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
        Schema::create('trx_penarikan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id');
            $table->unsignedBigInteger('bank_id');
            $table->string('jumlah_penarikan');
            $table->timestamps();

            $table->foreign('merchant_id')->references('id')->on('user_merchant')->cascadeOnDelete();
            $table->foreign('bank_id')->references('id')->on('merchant_rekening')->cascadeOnDelete();
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
