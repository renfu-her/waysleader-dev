<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function categories()
    {
        $categories = PostCategory::withCount(['posts' => function ($query) {
            $query->where('is_active', true);
        }])
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'posts_count' => $category->posts_count,
                    'created_at' => $category->created_at->format('Y-m-d H:i:s')
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
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'excerpt' => Str::limit(strip_tags($post->content), 100),
                    'image_url' => $post->image_url,
                    'created_at' => $post->created_at->format('Y-m-d H:i:s')
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
                'created_at' => $post->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $post->updated_at->format('Y-m-d H:i:s')
            ]
        ]);
    }

    private function transformPost($post)
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'excerpt' => $post->excerpt,
            'image_url' => $post->image_url,
            'created_at' => $post->created_at->format('Y-m-d H:i:s')
        ];
    }
}
