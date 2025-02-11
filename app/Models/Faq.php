<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model

{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'is_active',
        'sort'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort' => 'integer',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
