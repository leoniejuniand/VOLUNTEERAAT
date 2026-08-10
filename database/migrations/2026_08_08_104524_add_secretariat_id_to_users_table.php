<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom secretariat_id. Dibuat nullable() karena Super Admin mungkin tidak terikat pada 1 sekre tertentu.
            $table->foreignId('secretariat_id')->nullable()->constrained('secretariats')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['secretariat_id']);
            $table->dropColumn('secretariat_id');
        });
    }
};