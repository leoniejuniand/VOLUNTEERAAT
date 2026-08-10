<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Menambah kolom kuota dan deadline di tabel events
        Schema::table('events', function (Blueprint $table) {
            $table->dateTime('registration_deadline')->nullable()->after('event_date');
            $table->integer('quota')->nullable()->after('registration_deadline'); // Kosong berarti tidak terbatas
        });

        // Menambah kolom absensi di tabel pendaftaran
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->boolean('is_present')->default(false)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['registration_deadline', 'quota']);
        });

        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropColumn('is_present');
        });
    }
};