<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class LearningModule extends Model
{
    /**
     * White-listing attributes.
     */
    protected $fillable = [
        'topic_id',
        'title',
        'slug',
        'file_path',
        'file_type',
        'file_size',
        'description',
        'summary',
        'is_featured'
    ];

    /**
     * Cast attributes.
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'file_size' => 'integer',
    ];

    /**
     * Relasi ke Topik.
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Helper untuk mendapatkan URL file yang bisa diakses publik.
     */
    public function getFileUrl(): string
    {
        return Storage::url($this->file_path);
    }

    /**
     * Helper untuk memformat ukuran file agar enak dibaca manusia.
     */
    public function getFormattedFileSize(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        for ($i = 0; $bytes > 1024; $i++) $bytes /= 1024;
        return round($bytes, 2) . ' ' . $units[$i];
    }
}