<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Helper: Ekstrak ID YouTube dari URL lengkap.
     * Mencegah error jika user paste link https://youtube.com/...
     */
    private function parseYoutubeId($input)
    {
        if (empty($input)) return null;

        // Regex untuk menangkap ID dari berbagai format URL YouTube
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $input, $matches);
        
        // Jika cocok, kembalikan ID-nya (11 karakter). Jika tidak, kembalikan input asli biar divalidasi error.
        return $matches[1] ?? $input;
    }

    public function index()
    {
        $videos = Video::with('topic.category')
            ->latest()
            ->paginate(9);
            
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        $categories = Category::with('topics')->get();
        return view('videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // 1. SANITASI INPUT SEBELUM VALIDASI
        // Ini fitur "Smart Input" agar user tidak pusing format.
        
        $cleanData = [];

        // Jika user memilih Upload, KOSONGKAN youtube_id agar tidak validasi error
        if ($request->video_type === 'upload') {
            $cleanData['youtube_id'] = null;
        } 
        // Jika user memilih YouTube, otomatis ambil ID dari URL
        elseif ($request->video_type === 'youtube') {
            $cleanData['youtube_id'] = $this->parseYoutubeId($request->youtube_id);
            // Paksa video_file jadi null
            $cleanData['video_file'] = null;
        }

        // Gabungkan data bersih ke request
        $request->merge($cleanData);

        // 2. VALIDASI
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'title' => 'required|string|max:255',
            'video_type' => 'required|in:upload,youtube',
            'video_file' => 'nullable|required_if:video_type,upload|file|mimetypes:video/mp4,video/mpeg,video/x-matroska,video/quicktime|max:1048576',
            'youtube_id' => 'nullable|required_if:video_type,youtube|string|max:20', // Sekarang aman karena URL sudah dipotong jadi ID
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'level' => 'required|in:pemula,menengah,lanjut',
            'is_short' => 'nullable|boolean',
            'description' => 'required|string',
            'tags' => 'nullable|string',
        ]);

        // 3. PROSES SIMPAN
        $data = $request->except(['video_file', 'thumbnail']);
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        $data['summary'] = Str::limit($request->description, 150);
        $data['is_short'] = $request->has('is_short');
        $data['duration'] = $request->input('duration', 0);

        if ($request->video_type === 'upload' && $request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')->store('videos/raw', 'public');
            $data['youtube_id'] = null; 
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('videos/thumbnails', 'public');
        }

        Video::create($data);

        return redirect()->route('videos.index')->with('success', 'Video berhasil dipublikasikan!');
    }

    public function edit(Video $video)
    {
        $categories = Category::with('topics')->get();
        return view('videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        // 1. SANITASI INPUT (Sama seperti store)
        $cleanData = [];
        // Cek input youtube_id, kalau ada isinya, kita bersihkan URL-nya
        if ($request->has('youtube_id') && !empty($request->youtube_id)) {
            $cleanData['youtube_id'] = $this->parseYoutubeId($request->youtube_id);
        }
        $request->merge($cleanData);

        // 2. VALIDASI
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'title' => 'required|string|max:255',
            'level' => 'required|in:pemula,menengah,lanjut',
            'is_short' => 'nullable|boolean',
            // Kita validasi youtube_id longgar saja saat update karena opsional tergantung user ganti atau tidak
            'youtube_id' => 'nullable|string|max:20', 
        ]);

        // 3. PROSES UPDATE
        $data = $request->except(['video_file', 'thumbnail']);
        $data['slug'] = Str::slug($request->title);
        $data['summary'] = Str::limit($request->description, 150);
        $data['is_short'] = $request->has('is_short');

        // Handle File Baru
        if ($request->hasFile('video_file')) {
            if ($video->video_file) Storage::disk('public')->delete($video->video_file);
            $data['video_file'] = $request->file('video_file')->store('videos/raw', 'public');
            $data['youtube_id'] = null;
            $data['video_type'] = 'upload'; // Switch tipe
            
            if($request->has('duration')) {
                $data['duration'] = $request->duration;
            }
        }
        // Handle Ganti ke YouTube (Tanpa upload file baru)
        elseif ($request->has('youtube_id') && !empty($request->youtube_id)) {
             // Jika user mengisi youtube_id, kita anggap dia mau switch ke youtube
             $data['youtube_id'] = $request->youtube_id; // Sudah bersih dari merge di atas
             // Opsional: Hapus file lama jika mau hemat space
             // if ($video->video_file) Storage::disk('public')->delete($video->video_file);
             // $data['video_file'] = null; 
        }

        if ($request->hasFile('thumbnail')) {
            if ($video->thumbnail) Storage::disk('public')->delete($video->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('videos/thumbnails', 'public');
        }

        $video->update($data);

        return redirect()->route('videos.index')->with('success', 'Data video diperbarui!');
    }

    public function destroy(Video $video)
    {
        if ($video->video_file) Storage::disk('public')->delete($video->video_file);
        if ($video->thumbnail) Storage::disk('public')->delete($video->thumbnail);
        
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video telah dihapus dari database.');
    }
}