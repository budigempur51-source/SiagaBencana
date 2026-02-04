<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'title',
        'slug',
        'file_path',
        'cover_image', // Pastikan ini ada untuk fitur Cover
        'file_type',
        'file_size',
        'description',
        'summary',
        'is_featured',
    ];

    /**
     * Relasi ke Topic.
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Helper: Format ukuran file dari bytes ke KB/MB
     * Dipakai di: resources/views/modules/index.blade.php
     */
    public function getFormattedFileSize()
    {
        $bytes = $this->file_size;

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } elseif ($bytes == 1) {
            return $bytes . ' byte';
        } else {
            return '0 bytes';
        }
    }

    /**
     * Helper: Dapatkan URL publik file
     * Dipakai di: resources/views/modules/index.blade.php
     */
    public function getFileUrl()
    {
        return asset('storage/' . $this->file_path);
    }
}