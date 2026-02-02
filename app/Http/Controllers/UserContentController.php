<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use App\Models\LearningModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserContentController extends Controller
{
    /**
     * Langkah 1: Portal Pemilihan Kategori.
     */
    public function selection()
    {
        $categories = Category::withCount(['topics', 'videos'])->get();
        return view('user.selection', compact('categories'));
    }

    /**
     * Langkah 2: Hub Edukasi (Learning Hub).
     */
    public function index(Request $request, Category $category)
    {
        $search = $request->query('search');

        // Query Video
        $videos = Video::whereHas('topic', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })
        ->when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
        })
        ->with('topic')
        ->latest()
        ->paginate(9)
        ->withQueryString();

        // Query Modul
        $modules = LearningModule::whereHas('topic', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })
        ->when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%");
        })
        ->with('topic')
        ->latest()
        ->paginate(6, ['*'], 'modules_page')
        ->withQueryString();

        return view('user.index', compact('category', 'videos', 'modules', 'search'));
    }

    /**
     * Langkah 3: Reader Modul (Tampilan Buku).
     */
    public function read(LearningModule $module)
    {
        // Pastikan file ada
        if (!Storage::disk('public')->exists($module->file_path)) {
            abort(404, 'File modul tidak ditemukan di server.');
        }

        // Kita ambil URL file
        $fileUrl = Storage::url($module->file_path);

        return view('user.read_module', compact('module', 'fileUrl'));
    }
}