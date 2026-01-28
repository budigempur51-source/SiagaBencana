<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
{
    /**
     * Menampilkan daftar semua topik dengan relasi kategori.
     */
    public function index()
    {
        // Eager Loading 'category' untuk mencegah N+1 Query Problem
        $topics = Topic::with('category')->latest()->get();
        return view('topics.index', compact('topics'));
    }

    /**
     * Menampilkan form untuk membuat topik baru.
     */
    public function create()
    {
        $categories = Category::all();
        return view('topics.create', compact('categories'));
    }

    /**
     * Menyimpan data topik baru dan menangani upload thumbnail.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('thumbnail')) {
            // Disimpan di storage/app/public/thumbnails
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Topic::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'thumbnail' => $path,
        ]);

        return redirect()->route('topics.index')->with('success', 'Topik berhasil ditambahkan ke database!');
    }

    /**
     * Menampilkan form edit untuk topik tertentu.
     */
    public function edit(Topic $topic)
    {
        $categories = Category::all();
        return view('topics.edit', compact('topic', 'categories'));
    }

    /**
     * Memperbarui data topik dan mengganti thumbnail lama jika ada upload baru.
     */
    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ];

        if ($request->hasFile('thumbnail')) {
            // Hapus file fisik lama agar storage tidak bengkak (Clean Code)
            if ($topic->thumbnail) {
                Storage::disk('public')->delete($topic->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $topic->update($data);

        return redirect()->route('topics.index')->with('success', 'Data topik berhasil diperbarui!');
    }

    /**
     * Menghapus data topik dan file thumbnail-nya.
     */
    public function destroy(Topic $topic)
    {
        if ($topic->thumbnail) {
            Storage::disk('public')->delete($topic->thumbnail);
        }
        
        $topic->delete();

        return redirect()->route('topics.index')->with('success', 'Topik telah dihapus permanen!');
    }
}