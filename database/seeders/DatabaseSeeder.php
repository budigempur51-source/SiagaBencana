<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Setup User Admin (Jika belum ada)
        User::firstOrCreate(
            ['email' => 'admin@siagabencana.com'],
            [
                'name' => 'Admin Siaga Bencana',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 2. Setup Kategori TERKUNCI (Hanya 3 ini)
        // Kita gunakan firstOrCreate agar tidak duplikat saat di-seed ulang
        Category::firstOrCreate(
            ['slug' => 'anak-anak'], 
            ['name' => 'Anak-anak', 'description' => 'Edukasi bencana yang ramah untuk anak.']
        );

        Category::firstOrCreate(
            ['slug' => 'umkm'], 
            ['name' => 'UMKM', 'description' => 'Panduan ketahanan bencana untuk pelaku usaha.']
        );

        Category::firstOrCreate(
            ['slug' => 'kesehatan'], 
            ['name' => 'Kesehatan', 'description' => 'Informasi medis dan pertolongan pertama.']
        );

        // Opsional: Tambahkan topik default jika perlu nanti
    }
}