<?php

namespace App\Http\Controllers;

use App\Models\LearningModule;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LearningModuleController extends Controller
{
    /**
     * List modul pembelajaran untuk admin.
     */
    public function index()
    {
        $modules = LearningModule::with(['topic.category'])->latest()->get();
        return view('modules.index', compact('modules'));
    }

    /**
     * Form tambah modul.
     */
    public function create()
    {
        $topics = Topic::with('category')->get();
        return view('modules.create', compact('topics'));
    }

    /**
     * Simpan modul baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'topic_id'    => 'required|exists:topics,id',
            'title'       => 'required|string|max:255',
            'file'        => 'required|file|mimes:pdf|max:20480', // PDF Max 20MB
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Cover Max 2MB
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        // 1. Upload File PDF (Wajib)
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('learning-modules', 'public');
            
            $validated['file_path'] = $path;
            $validated['file_type'] = $file->getClientOriginalExtension();
            $validated['file_size'] = $file->getSize();
        }

        // 2. Upload Cover Image (Opsional)
        if ($request->hasFile('cover_image')) {
            $cover = $request->file('cover_image');
            $coverPath = $cover->store('module-covers', 'public');
            $validated['cover_image'] = $coverPath;
        }

        $validated['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        $validated['summary'] = Str::limit($request->description, 150);
        $validated['is_featured'] = $request->has('is_featured');

        LearningModule::create($validated);

        return redirect()->route('modules.index')->with('success', 'Modul berhasil ditambahkan!');
    }

    /**
     * Form edit modul.
     */
    public function edit(LearningModule $module)
    {
        $topics = Topic::with('category')->get();
        return view('modules.edit', compact('module', 'topics'));
    }

    /**
     * Update modul.
     */
    public function update(Request $request, LearningModule $module)
    {
        $validated = $request->validate([
            'topic_id'    => 'required|exists:topics,id',
            'title'       => 'required|string|max:255',
            'file'        => 'nullable|file|mimes:pdf|max:20480',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        // 1. Cek Update PDF
        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($module->file_path && Storage::disk('public')->exists($module->file_path)) {
                Storage::disk('public')->delete($module->file_path);
            }

            $file = $request->file('file');
            $path = $file->store('learning-modules', 'public');
            
            $validated['file_path'] = $path;
            $validated['file_type'] = $file->getClientOriginalExtension();
            $validated['file_size'] = $file->getSize();
        }

        // 2. Cek Update Cover Image
        if ($request->hasFile('cover_image')) {
            // Hapus cover lama jika ada
            if ($module->cover_image && Storage::disk('public')->exists($module->cover_image)) {
                Storage::disk('public')->delete($module->cover_image);
            }

            $cover = $request->file('cover_image');
            $coverPath = $cover->store('module-covers', 'public');
            $validated['cover_image'] = $coverPath;
        }

        $validated['slug'] = Str::slug($request->title);
        $validated['summary'] = Str::limit($request->description, 150);
        $validated['is_featured'] = $request->has('is_featured');

        $module->update($validated);

        return redirect()->route('modules.index')->with('success', 'Modul berhasil diperbarui!');
    }

    /**
     * Hapus modul dan semua filenya.
     */
    public function destroy(LearningModule $module)
    {
        // Hapus File PDF
        if ($module->file_path && Storage::disk('public')->exists($module->file_path)) {
            Storage::disk('public')->delete($module->file_path);
        }

        // Hapus Cover Image
        if ($module->cover_image && Storage::disk('public')->exists($module->cover_image)) {
            Storage::disk('public')->delete($module->cover_image);
        }
        
        $module->delete();
        return redirect()->route('modules.index')->with('success', 'Modul telah dihapus!');
    }
}