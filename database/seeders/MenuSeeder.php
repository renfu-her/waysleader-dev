<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'name' => '簡介',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => '團隊師資',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => '與我聯繫',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => '課程分級',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => '創意展示',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => '成果分享',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Q&A',
                'sort_order' => 7,
                'is_active' => true,
            ],
        ];

        // 刪除所有現有的選單
        Menu::truncate();

        // 重新插入選單 
        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
} 