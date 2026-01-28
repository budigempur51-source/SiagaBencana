<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    // Matikan mass assignment protection karena kita akan validasi di Controller
    protected $guarded = [];

    // Relasi: Topic milik satu Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Topic punya banyak Video
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}