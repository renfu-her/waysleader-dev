<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlbumImage extends Model
{
    protected $fillable = [
        'album_id',
        'image',
        'sort'
    ];

    protected $casts = [
        'sort' => 'integer'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

}
