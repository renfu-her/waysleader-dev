<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\AchievementCategory;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function categories()
    {
        $categories = AchievementCategory::where('is_active', true)
            ->orderBy('sort')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'description' => $category->description,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }

    public function categoryAchievements($slug)
    {
        $category = AchievementCategory::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $achievements = $category->achievements()
            ->where('is_active', true)
            ->orderBy('sort')
            ->get()
            ->map(function ($achievement) {
                return [
                    'id' => $achievement->id,
                    'title' => $achievement->title,
                    'content' => $achievement->content,
                    'image_url' => $achievement->image ? asset('storage/' . $achievement->image) : null,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => [
                'category' => [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'description' => $category->description,
                ],
                'achievements' => $achievements
            ]
        ]);
    }

    public function show($id)
    {
        $achievement = Achievement::where('is_active', true)
            ->with('category')
            ->findOrFail($id);

        $data = [
            'id' => $achievement->id,
            'title' => $achievement->title,
            'content' => $achievement->content,
            'image_url' => $achievement->image ? asset('storage/' . $achievement->image) : null,
            'category' => [
                'id' => $achievement->category->id,
                'name' => $achievement->category->name,
                'slug' => $achievement->category->slug,
            ]
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
} 