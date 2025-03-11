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
        Schema::create('detail_tikets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemesanan');
            $table->unsignedBigInteger('id_tiket');
            $table->unsignedBiginteger('id_pembayaran');
            $table->timestamps();

            $table->foreign('id_pemesanan')->references('id')->on('pemesanans')->onDelete('cascade');
            $table->foreign('id_tiket')->references('id')->on('tikets')->onDelete('cascade');
            $table->foreign('id_pembayaran')->references('id')->on('pembayarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_tikets');
    }
};
