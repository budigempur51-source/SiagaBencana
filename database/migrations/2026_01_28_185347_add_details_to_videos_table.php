<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            // Deskripsi lengkap video
            $table->longText('description')->nullable()->after('summary');
            // Untuk menyimpan hashtags/tags dalam format JSON atau string
            $table->string('tags')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn(['description', 'tags']);
        });
    }
};