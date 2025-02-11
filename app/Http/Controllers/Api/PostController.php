<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function categories()
    {
        $categories = PostCategory::withCount(['posts' => function ($query) {
            $query->where('is_active', true);
        }])
            ->orderBy('sort')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            });

        return response()->json([
            'data' => $categories,
            'meta' => [
                'total' => $categories->count()
            ]
        ]);
    }

    public function categoryPosts(PostCategory $category)
    {
        $posts = $category->posts()
            ->where('is_active', true)
            ->orderBy('sort')
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                ];
            });

        return response()->json([
            'data' => [
                'category' => [
                    'id' => $category->id,
                    'name' => $category->name
                ],
                'posts' => $posts
            ],
        ]);
    }

    public function show(Post $post)
    {
        if (!$post->is_active) {
            abort(404);
        }

        return response()->json([
            'data' => [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'image_url' => $post->image_url,
                'category' => [
                    'id' => $post->post_category_id,
                    'name' => $post->category->name
                ],
            ]
        ]);
    }
}
