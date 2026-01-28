<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    protected $guarded = [];

    /**
     * Relasi ke Topik (Setiap video punya satu topik induk)
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Helper untuk mendapatkan URL thumbnail YouTube otomatis dari ID
     */
    public function getYoutubeThumbnail(): string
    {
        return "https://img.youtube.com/vi/{$this->youtube_id}/maxresdefault.jpg";
    }
}