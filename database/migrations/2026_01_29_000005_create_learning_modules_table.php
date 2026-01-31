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
        Schema::create('learning_modules', function (Blueprint $table) {
            $table->id();
            // Relasi ke topik agar terstruktur berdasarkan materi bencana
            $table->foreignId('topic_id')->constrained('topics')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('file_path'); // Path file PDF/Dokumen di storage
            $table->string('file_type')->default('pdf'); // Menyimpan tipe file
            $table->integer('file_size')->default(0); // Ukuran file dalam KB/MB
            $table->text('description')->nullable();
            $table->text('summary')->nullable(); // Ringkasan untuk list view
            $table->boolean('is_featured')->default(false); // Untuk highlight di dashboard
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_modules');
    }
};