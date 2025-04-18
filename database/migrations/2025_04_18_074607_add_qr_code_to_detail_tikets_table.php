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
        Schema::table('detail_tikets', function (Blueprint $table) {
            $table->datetime('expired_at')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('qr_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_tikets', function (Blueprint $table) {
            $table->dropColumn(['qr_code', 'qr_path', 'expired_at']);
        });
    }
};
