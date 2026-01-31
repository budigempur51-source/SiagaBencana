<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Konsolidasi: Membuat tabel videos dengan dukungan upload fisik dan YouTube.
     */
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            // Relasi ke Topik (Anak-anak, UMKM, Kesehatan akan masuk lewat relasi ini)
            $table->foreignId('topic_id')->constrained('topics')->cascadeOnDelete();
            
            $table->string('title');
            $table->string('slug')->unique();
            
            // Media Source: Bisa YouTube ID atau File Fisik (Self-hosted)
            $table->string('youtube_id')->nullable(); 
            $table->string('video_file')->nullable(); // Untuk upload maksimal 1GB
            $table->string('thumbnail')->nullable(); // Thumbnail kustom
            
            // Metadata Konten
            $table->integer('duration')->default(0); // Durasi dalam menit
            $table->enum('level', ['pemula', 'menengah', 'lanjut'])->default('pemula');
            
            // Informasi Deskriptif
            $table->text('summary')->nullable(); // Ringkasan pendek
            $table->longText('description')->nullable(); // Deskripsi lengkap/materi
            $table->string('tags')->nullable(); // Hashtags/Tags
            
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