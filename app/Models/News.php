<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'image',
        'content',
        'is_active',
        'is_new',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
