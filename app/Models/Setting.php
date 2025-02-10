<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_logo',
        'site_favicon',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'contact_email',
        'contact_phone',
        'address',
        'facebook_url',
        'instagram_url',
        'line_url',
    ];

    
}
