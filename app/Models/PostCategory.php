<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Post;

class PostCategory extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
