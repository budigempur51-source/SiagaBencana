<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('topic.category')->latest()->get();
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        // Ambil topik dengan kategorinya untuk dropdown yang informatif
        $topics = Topic::with('category')->get();
        return view('videos.create', compact('topics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'title' => 'required|string|max:255',
            'youtube_id' => 'required|string|max:20',
            'duration' => 'required|integer|min:1',
            'level' => 'required|in:pemula,menengah,lanjut',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
        ]);

        Video::create([
            'topic_id' => $request->topic_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'youtube_id' => $request->youtube_id,
            'duration' => $request->duration,
            'level' => $request->level,
            'summary' => Str::limit($request->description, 150), // Automatis buat ringkasan
            'description' => $request->description,
            'tags' => $request->tags,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video berhasil dipublish!');
    }

    public function edit(Video $video)
    {
        $topics = Topic::with('category')->get();
        return view('videos.edit', compact('video', 'topics'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'title' => 'required|string|max:255',
            'youtube_id' => 'required|string|max:20',
            'duration' => 'required|integer',
            'level' => 'required|in:pemula,menengah,lanjut',
        ]);

        $video->update([
            'topic_id' => $request->topic_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'youtube_id' => $request->youtube_id,
            'duration' => $request->duration,
            'level' => $request->level,
            'description' => $request->description,
            'tags' => $request->tags,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video berhasil diupdate!');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video telah dihapus!');
    }
}