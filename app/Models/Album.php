<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    protected $fillable = [
        'title',
        'image',
        'content',
        'is_active'
    ];

    public function images(): HasMany
    {
        return $this->hasMany(AlbumImage::class);
    }
}
