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
        // Membuat Akun Admin Utama secara otomatis
        // Akun ini akan selalu ada setiap kali Anda menjalankan migrate:fresh --seed
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Cek berdasarkan email agar tidak duplikat
            [
                'name' => 'Admin SiagaBencana',
                'password' => Hash::make('password'), // Silakan ganti password di sini
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Anda bisa menambahkan seeding kategori atau topik di sini nanti
        $this->command->info('Akun Admin berhasil dibuat: admin@gmail.com | password: password');
    }
}