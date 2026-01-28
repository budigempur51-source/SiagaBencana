<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            // Relasi ke topics
            $table->foreignId('topic_id')->constrained('topics')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('youtube_id'); // Menyimpan ID video (contoh: dQw4w9WgXcQ)
            $table->integer('duration')->default(0); // Durasi dalam menit
            $table->enum('level', ['pemula', 'menengah', 'lanjut'])->default('pemula');
            $table->text('summary')->nullable(); // Ringkasan materi
            $table->boolean('is_featured')->default(false); // Untuk highlight di homepage
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};