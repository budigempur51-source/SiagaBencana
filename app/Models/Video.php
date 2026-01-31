<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    /**
     * White-listing attributes untuk keamanan Mass Assignment.
     */
    protected $fillable = [
        'topic_id',
        'title',
        'slug',
        'youtube_id',
        'video_file',
        'thumbnail',
        'duration',
        'level',
        'summary',
        'description',
        'tags',
        'is_featured'
    ];

    /**
     * Casting tipe data agar konsisten di aplikasi.
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'duration' => 'integer',
    ];

    /**
     * Relasi ke Topik.
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Smart Thumbnail Logic:
     * Mengambil thumbnail upload kustom, jika tidak ada baru ambil dari YouTube.
     */
    public function getThumbnailUrl(): string
    {
        if ($this->thumbnail) {
            return Storage::url($this->thumbnail);
        }

        if ($this->youtube_id) {
            return "https://img.youtube.com/vi/{$this->youtube_id}/maxresdefault.jpg";
        }

        return "https://placehold.co/600x400?text=No+Thumbnail";
    }

    /**
     * Smart Player Logic:
     * Memberikan path file lokal jika ada, jika tidak memberikan link embed YouTube.
     */
    public function getVideoSource(): ?string
    {
        if ($this->video_file) {
            return Storage::url($this->video_file);
        }

        return $this->youtube_id ? "https://www.youtube.com/embed/{$this->youtube_id}" : null;
    }
}