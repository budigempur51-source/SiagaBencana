<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Menampilkan form edit kategori.
     * Kita izinkan edit barangkali admin ingin merubah deskripsi atau memperbaiki typo nama.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update data kategori.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Update slug otomatis dari nama baru jika nama berubah
        // $validated['slug'] = Str::slug($validated['name']); 
        // Note: Biasanya slug kategori inti sebaiknya tidak diubah agar link SEO tidak putus, 
        // tapi jika request name berubah, kita update saja standard.

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // --- RESTRICTED METHODS (DIHAPUS/DILARANG) ---
    // create(), store(), destroy() dihapus untuk mencegah penambahan/penghapusan kategori.
}