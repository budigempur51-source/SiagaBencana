<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use App\Models\LearningModule;
use Illuminate\Http\Request;

class UserContentController extends Controller
{
    /**
     * Langkah 1: Halaman Pemilihan Kategori (Anak-anak, UMKM, Kesehatan).
     */
    public function selection()
    {
        $categories = Category::all();
        return view('user.selection', compact('categories'));
    }

    /**
     * Langkah 2: Hub Edukasi (Tampilan seperti YouTube).
     */
    public function index(Request $request, Category $category)
    {
        $search = $request->query('search');

        // Ambil Video berdasarkan kategori (lewat topik) dan filter pencarian
        $videos = Video::whereHas('topic', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })
        ->when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
        })
        ->latest()
        ->get();

        // Ambil Modul berdasarkan kategori
        $modules = LearningModule::whereHas('topic', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })
        ->when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%");
        })
        ->latest()
        ->get();

        return view('user.index', compact('category', 'videos', 'modules', 'search'));
    }
}