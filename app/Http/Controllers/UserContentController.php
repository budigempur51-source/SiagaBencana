<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use App\Models\LearningModule;
use Illuminate\Http\Request;

class UserContentController extends Controller
{
    /**
     * Langkah 1: Portal Pemilihan Kategori.
     * Tampilan harus clean dan mengundang klik.
     */
    public function selection()
    {
        // Ambil kategori beserta jumlah kontennya untuk ditampilkan sebagai badge
        $categories = Category::withCount(['topics', 'videos'])->get();
        return view('user.selection', compact('categories'));
    }

    /**
     * Langkah 2: Hub Edukasi (Learning Hub).
     * Disini user menghabiskan waktu.
     */
    public function index(Request $request, Category $category)
    {
        $search = $request->query('search');

        // 1. QUERY VIDEO (Paginate 9 item per load)
        // Kita gunakan Eager Loading (with topic) biar query ringan
        $videos = Video::whereHas('topic', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })
        ->when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
        })
        ->with('topic') // Penting untuk performa
        ->latest()
        ->paginate(9)
        ->withQueryString(); // Agar pagination tetap membawa parameter search

        // 2. QUERY MODUL (Paginate 6 item)
        $modules = LearningModule::whereHas('topic', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })
        ->when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%");
        })
        ->with('topic')
        ->latest()
        ->paginate(6, ['*'], 'modules_page') // Nama page beda biar gak konflik sama video
        ->withQueryString();

        return view('user.index', compact('category', 'videos', 'modules', 'search'));
    }
}