<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use App\Models\Video;
use App\Models\LearningModule;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard dengan statistik riil.
     */
    public function index()
    {
        // Mengambil jumlah data untuk statistik utama
        $stats = [
            'categories_count' => Category::count(),
            'topics_count'     => Topic::count(),
            'videos_count'     => Video::count(),
            'modules_count'    => LearningModule::count(),
        ];

        // Mengambil data video terbaru yang baru diunggah
        $recent_videos = Video::with('topic')->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recent_videos'));
    }
}