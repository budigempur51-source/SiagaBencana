<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'title',
        'slug',
        'youtube_id',
        'video_file',
        'thumbnail',
        'duration',
        'level',
        'is_short', // Added: Agar fitur shorts bisa disimpan
        'summary',
        'description',
        'tags',
        'is_featured',
    ];

    /**
     * Relasi ke Topic.
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}