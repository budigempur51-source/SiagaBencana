<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VideoStreamController extends Controller
{
    /**
     * Stream video file with support for range requests (seeking).
     */
    public function stream(Video $video)
    {
        // 1. Cek apakah ini video upload (bukan YouTube)
        if ($video->youtube_id) {
            abort(404);
        }

        // 2. Ambil path absolut file di server
        // Pastikan path sesuai dengan disk yang dipakai (public)
        $path = $video->video_file;
        
        // Cek keberadaan file di Storage Disk
        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File video tidak ditemukan.');
        }

        // 3. Dapatkan Full Path untuk response file
        $fullPath = Storage::disk('public')->path($path);

        // 4. Return file menggunakan helper Laravel response()->file()
        // Fungsi ini otomatis menangani header 'Accept-Ranges: bytes'
        // dan 'Content-Range' yang dibutuhkan browser untuk fitur skip/seek.
        return response()->file($fullPath, [
            'Content-Type' => 'video/mp4',
            'Cache-Control' => 'no-cache, no-store, must-revalidate', // Opsional: paksa browser validasi stream
        ]);
    }
}