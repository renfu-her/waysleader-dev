<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AchievementCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sort',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function achievements(): HasMany
    {
        return $this->hasMany(Achievement::class, 'category_id');
    }
} 