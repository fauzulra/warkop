<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            // Tambahkan kolom status setelah total
            $table->dropColumn('status');
            $table->enum('status', ['ongoing', 'selesai', 'dibatalkan'])
                  ->default('ongoing')
                  ->after('total');

           
        });
    }

    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            // Kembalikan kolom payment dan change_return

            // Hapus kolom status
             $table->dropColumn('status');

            // Opsional: kembalikan kolom status lama (misal string)
            $table->string('status')->after('total');
        });
    }
};
