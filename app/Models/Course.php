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
        'is_new'
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
        if (!$this->image) {
            return null;
        }

        // 檢查是否已經是完整 URL
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // 生成正確的儲存路徑
        return asset(Storage::url($this->image));
    }
}
