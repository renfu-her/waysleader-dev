<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'title',
        'content',
        'is_active',
        'is_new'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_new' => 'boolean'
    ];

    public function images(): HasMany
    {
        return $this->hasMany(CourseImage::class)->orderBy('sort');
    }
}
