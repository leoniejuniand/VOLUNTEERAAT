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
            Schema::create('event_registrations', function (Blueprint $table) {
                $table->id();
                
                // Siapa yang mendaftar?
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                
                // Mendaftar ke kegiatan apa?
                $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
                
                // Status pendaftaran (Menunggu, Diterima, Ditolak)
                $table->string('status')->default('Menunggu Konfirmasi');
                
                $table->timestamps();
            });
        }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
