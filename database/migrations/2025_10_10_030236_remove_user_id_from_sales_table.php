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
        Schema::table('sales', function (Blueprint $table) {
            // Hapus foreign key dulu (pastikan nama constraint sesuai)
            $table->dropForeign(['user_id']);
            // Lalu hapus kolom user_id
            $table->dropColumn('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            // Jika ingin rollback, tambahkan lagi kolom user_id
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }
};
