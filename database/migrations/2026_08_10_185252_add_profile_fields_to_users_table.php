<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('whatsapp_number')->nullable()->after('email');
            $table->text('address')->nullable()->after('whatsapp_number');
            $table->string('institution')->nullable()->after('address');
            $table->string('profile_picture')->nullable()->after('institution');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['whatsapp_number', 'address', 'institution', 'profile_picture']);
        });
    }
};