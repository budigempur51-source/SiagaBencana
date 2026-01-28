<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Struktur Database Edukasi Bencana (Manual Build).
     */
    public function up(): void
    {
        // 1. Users (Admin) - Bawaan Laravel kita modif dikit
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('admin'); // admin / user
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Categories (Anak, UKM, Kesehatan)
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('slug')->unique();
            $table->string('color')->default('#3b82f6'); // Buat styling kartu
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 3. Topics (Gempa, Banjir, P3K)
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable(); // Path gambar upload
            $table->timestamps();
        });

        // 4. Videos (Konten Edukasi)
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('youtube_id'); // ID Youtube (Hemat Storage)
            $table->integer('duration')->default(0); // Menit
            $table->enum('level', ['pemula', 'menengah', 'lanjut'])->default('pemula');
            $table->text('summary')->nullable(); // Ringkasan teks
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        // Tabel untuk Session (Wajib ada di Laravel 11)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('topics');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('users');
    }
};