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
                $table->string('title'); // Nama kegiatan
                $table->text('description'); // Deskripsi kegiatan
                $table->date('event_date'); // Tanggal pelaksanaan
                $table->string('location'); // Tempat pelaksanaan
                
                // Relasi ke tabel secretariats (Kegiatan ini milik sekre mana?)
                $table->foreignId('secretariat_id')->constrained('secretariats')->onDelete('cascade');
                
                $table->string('status')->default('Buka'); // Status: Buka, Tutup, Selesai
                $table->timestamps();
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
