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
        Schema::create('tikets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_event');
            $table->enum('jenis_tiket', ['Early Bird', 'Reguler', 'VIP']);
            $table->integer('harga_tiket');
            $table->integer('kuota_tiket');
            $table->integer('tiket_terjual');
            $table->enum('status', ['Aktif', 'Tidak Aktif', 'Kadaluwarsa']);
            $table->timestamps();

            $table->foreign('id_event')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tikets');
    }
};
