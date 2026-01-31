<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Topic;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('topic.category')->latest()->get();
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        // Ambil kategori yang diinginkan (Anak-anak, UMKM, Kesehatan)
        // Pastikan kategori ini sudah ada di DB via Seeder atau Manual.
        $categories = Category::with('topics')->get();
        return view('videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi ketat. mimetypes video/mp4, dsb. Max 1GB = 1048576 KB
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'title' => 'required|string|max:255',
            'video_type' => 'required|in:upload,youtube',
            'video_file' => 'nullable|required_if:video_type,upload|file|mimetypes:video/mp4,video/mpeg,video/x-matroska,video/quicktime|max:1048576',
            'youtube_id' => 'nullable|required_if:video_type,youtube|string|max:20',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'duration' => 'required|integer|min:1',
            'level' => 'required|in:pemula,menengah,lanjut',
            'description' => 'required|string',
            'tags' => 'nullable|string',
        ]);

        $data = $request->except(['video_file', 'thumbnail']);
        $data['slug'] = Str::slug($request->title);
        $data['summary'] = Str::limit($request->description, 150);

        // Handle Video File Upload
        if ($request->video_type === 'upload' && $request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')->store('videos/raw', 'public');
            $data['youtube_id'] = null; // Pastikan YouTube ID kosong jika upload file
        }

        // Handle Thumbnail Upload
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('videos/thumbnails', 'public');
        }

        Video::create($data);

        return redirect()->route('videos.index')->with('success', 'Video berhasil diupload ke sistem!');
    }

    public function edit(Video $video)
    {
        $categories = Category::with('topics')->get();
        return view('videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'title' => 'required|string|max:255',
            'duration' => 'required|integer',
            'level' => 'required|in:pemula,menengah,lanjut',
        ]);

        $data = $request->except(['video_file', 'thumbnail']);
        $data['slug'] = Str::slug($request->title);
        $data['summary'] = Str::limit($request->description, 150);

        // Update Video File jika ada yang baru
        if ($request->hasFile('video_file')) {
            if ($video->video_file) Storage::disk('public')->delete($video->video_file);
            $data['video_file'] = $request->file('video_file')->store('videos/raw', 'public');
        }

        // Update Thumbnail jika ada yang baru
        if ($request->hasFile('thumbnail')) {
            if ($video->thumbnail) Storage::disk('public')->delete($video->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('videos/thumbnails', 'public');
        }

        $video->update($data);

        return redirect()->route('videos.index')->with('success', 'Data video diperbarui!');
    }

    public function destroy(Video $video)
    {
        // Hapus file fisik agar tidak memenuhi storage server
        if ($video->video_file) Storage::disk('public')->delete($video->video_file);
        if ($video->thumbnail) Storage::disk('public')->delete($video->thumbnail);
        
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video permanen dihapus!');
    }
}