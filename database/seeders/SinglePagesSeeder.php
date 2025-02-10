<?php

namespace Database\Seeders;

use App\Models\SinglePage;
use Illuminate\Database\Seeder;

class SinglePagesSeeder extends Seeder
{
    public function run()
    {
        $pages = [
            [
                'slug' => 'about',
                'title' => '簡介',
                'content' => '簡介內容'
            ],
            [
                'slug' => 'contact',
                'title' => '與我聯繫',
                'content' => '聯繫內容'
            ],
            [
                'slug' => 'features',
                'title' => '課程特色',
                'content' => '特色內容'
            ],
        ];

        foreach ($pages as $page) {
            SinglePage::create($page);
        }
    }
} 