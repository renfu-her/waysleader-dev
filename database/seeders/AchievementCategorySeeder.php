<?php

namespace Database\Seeders;

use App\Models\AchievementCategory;
use Illuminate\Database\Seeder;

class AchievementCategorySeeder extends Seeder
{
    public function run()
    {
        AchievementCategory::create([
            'name' => '創意展示',
            'slug' => 'creative',
            'description' => '展示學生們的創意作品和創新想法',
            'sort' => 1,
            'is_active' => true,
        ]);

        AchievementCategory::create([
            'name' => '成果分享',
            'slug' => 'sharing',
            'description' => '分享學生們的學習成果和心得',
            'sort' => 2,
            'is_active' => true,
        ]);
    }
} 