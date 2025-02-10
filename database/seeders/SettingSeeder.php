<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        Setting::create([
            'site_name' => '我的網站',
            'seo_title' => '我的網站 - 首頁',
            'seo_description' => '這是一個示範網站',
            'seo_keywords' => '示範,網站,laravel',
            'contact_email' => 'contact@example.com',
        ]);
    }
}
