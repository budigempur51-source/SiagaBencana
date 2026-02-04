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
        Schema::table('learning_modules', function (Blueprint $table) {
            // Menambahkan kolom cover_image setelah kolom file_path
            // Kita set nullable() karena modul lama mungkin belum punya cover
            $table->string('cover_image')->nullable()->after('file_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learning_modules', function (Blueprint $table) {
            $table->dropColumn('cover_image');
        });
    }
};