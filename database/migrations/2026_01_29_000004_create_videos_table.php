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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            // Relasi ke Topik
            $table->foreignId('topic_id')->constrained('topics')->cascadeOnDelete();
            
            $table->string('title');
            $table->string('slug')->unique();
            
            // Media Source
            $table->string('youtube_id')->nullable(); 
            $table->string('video_file')->nullable(); // File path
            $table->string('thumbnail')->nullable();
            
            // Metadata Konten
            $table->integer('duration')->default(0); // Durasi dalam menit
            $table->enum('level', ['pemula', 'menengah', 'lanjut'])->default('pemula');
            
            // FITUR BARU: Penanda Video Short (Vertical / < 60s)
            $table->boolean('is_short')->default(false);

            // Informasi Deskriptif
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('tags')->nullable();
            
            // Management
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};