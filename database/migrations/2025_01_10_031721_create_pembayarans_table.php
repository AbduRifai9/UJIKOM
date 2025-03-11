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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemesanan');
            $table->integer('jumlah_pembayaran');
            $table->enum('status_pembayaran', ['Sukses', 'Gagal']);
            $table->enum('metode_pembayaran', ['Kartu kredit', 'Transfer Bank']);
            $table->timestamps();

            $table->foreign('id_pemesanan')->references('id')->on('pemesanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
