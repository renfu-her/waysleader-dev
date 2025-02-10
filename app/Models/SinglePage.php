<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SinglePage extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'image',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active',
        'sort'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort' => 'integer',
    ];
}
