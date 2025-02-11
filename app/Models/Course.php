<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'content',
        'is_active',
        'is_new',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];


    protected $casts = [
        'is_active' => 'boolean',
        'is_new' => 'boolean'
    ];

    public function images()
    {
        return $this->hasMany(CourseImage::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset(Storage::url($this->image)) : null;
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }
}
