<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Opsional
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin (Hanya jika belum ada)
        // Kita pakai firstOrCreate agar tidak error 'Duplicate entry' kalau di-seed ulang
        User::firstOrCreate(
            ['email' => 'admin@siagabencana.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // Default password
                'role' => UserRole::ADMIN, // PENTING: Pakai Enum, jangan string 'admin'
                'email_verified_at' => now(),
            ]
        );

        // 2. Buat Akun User Biasa (Untuk Testing)
        User::firstOrCreate(
            ['email' => 'user@siagabencana.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role' => UserRole::USER,
                'email_verified_at' => now(),
            ]
        );

        // 3. Buat 3 Kategori Utama (Anak-anak, UMKM, Kesehatan)
        // Saya asumsikan "topik" yang kamu maksud adalah "Category" di struktur kita
        $categories = [
            'Anak-anak' => 'Materi edukasi bencana khusus untuk anak-anak.',
            'UMKM'      => 'Panduan mitigasi bencana untuk pelaku usaha UMKM.',
            'Kesehatan' => 'Prosedur tanggap darurat medis dan kesehatan.',
        ];

        foreach ($categories as $name => $desc) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name)], // Cek berdasarkan slug
                [
                    'name' => $name,
                    'description' => $desc, // Pastikan kolom ini ada di migrasi categories
                    // Jika tidak ada kolom description, hapus baris ini
                ]
            );
        }

        // Jika kamu punya seeder lain, panggil di sini
        // $this->call([
        //     TopicSeeder::class,
        // ]);
    }
}