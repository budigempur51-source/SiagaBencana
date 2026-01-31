<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * White-listing attributes untuk keamanan Mass Assignment.
     */
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
}