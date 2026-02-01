<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color',
        'description'
    ];

    /**
     * Relasi ke Topik.
     */
    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * Relasi ke Video (Melalui Topik).
     * Penting untuk menghitung jumlah video per kategori.
     */
    public function videos(): HasManyThrough
    {
        return $this->hasManyThrough(Video::class, Topic::class);
    }
}