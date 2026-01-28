<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Akun Admin Super
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), // Passwordnya: password
            'role' => 'admin',
        ]);

        // Buat Kategori Default
        \App\Models\Category::insert([
            [
                'name' => 'Anak-Anak',
                'slug' => 'anak-anak',
                'color' => '#f59e0b', // Amber/Kuning
                'description' => 'Materi edukasi menyenangkan untuk anak usia dini dan sekolah dasar.',
                'created_at' => now(),
            ],
            [
                'name' => 'UMKM & Ekonomi',
                'slug' => 'umkm-ekonomi',
                'color' => '#3b82f6', // Biru
                'description' => 'Panduan pemulihan usaha dan manajemen keuangan pasca bencana.',
                'created_at' => now(),
            ],
            [
                'name' => 'Kesehatan & Relawan',
                'slug' => 'kesehatan-relawan',
                'color' => '#10b981', // Hijau
                'description' => 'Prosedur medis darurat dan panduan untuk tim relawan.',
                'created_at' => now(),
            ]
        ]);
    }
}