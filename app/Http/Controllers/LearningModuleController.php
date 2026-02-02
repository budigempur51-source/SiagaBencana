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
        // PENTING: Untuk fitur "Buku Digital", kita batasi hanya PDF.
        // File Word/PPT tidak bisa dirender browser native sebagai buku.
        $validated = $request->validate([
            'topic_id'    => 'required|exists:topics,id',
            'title'       => 'required|string|max:255',
            'file'        => 'required|file|mimes:pdf|max:20480', // Hanya PDF, Max 20MB
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('learning-modules', 'public');
            
            $validated['file_path'] = $path;
            $validated['file_type'] = $file->getClientOriginalExtension(); // Pasti 'pdf'
            $validated['file_size'] = $file->getSize();
        }

        $validated['slug'] = Str::slug($request->title) . '-' . Str::random(5); // Tambah random string biar slug unik
        $validated['summary'] = Str::limit($request->description, 150);
        $validated['is_featured'] = $request->has('is_featured');

        LearningModule::create($validated);

        return redirect()->route('modules.index')->with('success', 'Modul PDF berhasil diunggah dan siap dibaca!');
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
            'file'        => 'nullable|file|mimes:pdf|max:20480', // Hanya PDF
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('file')) {
            if ($module->file_path) {
                Storage::disk('public')->delete($module->file_path);
            }

            $file = $request->file('file');
            $path = $file->store('learning-modules', 'public');
            
            $validated['file_path'] = $path;
            $validated['file_type'] = $file->getClientOriginalExtension();
            $validated['file_size'] = $file->getSize();
        }

        $validated['slug'] = Str::slug($request->title);
        $validated['summary'] = Str::limit($request->description, 150);
        $validated['is_featured'] = $request->has('is_featured');

        $module->update($validated);

        return redirect()->route('modules.index')->with('success', 'Modul berhasil diperbarui!');
    }

    /**
     * Hapus modul dan filenya.
     */
    public function destroy(LearningModule $module)
    {
        if ($module->file_path) {
            Storage::disk('public')->delete($module->file_path);
        }
        
        $module->delete();
        return redirect()->route('modules.index')->with('success', 'Modul telah dihapus!');
    }
}