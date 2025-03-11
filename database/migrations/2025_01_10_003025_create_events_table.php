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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event');
            $table->string('deskripsi');
            $table->string('poster');
            $table->date('tanggal_mulai');
            $table->time('waktu_mulai');
            $table->date('tanggal_selesai');
            $table->time('waktu_selesai');
            $table->unsignedBigInteger('id_lokasi');
            $table->enum('status', ['Segera', 'Sedang Berlangsung', 'Selesai', 'Dibatalkan']);
            $table->timestamps();

            $table->foreign('id_lokasi')->references('id')->on('lokasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
