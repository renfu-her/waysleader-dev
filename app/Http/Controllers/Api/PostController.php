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
        $categories = PostCategory::with(['posts' => function ($query) {
            $query->where('is_active', true);
        }])
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'posts_count' => $category->posts->count()
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }

    public function categoryPosts($categoryId)
    {
        $category = PostCategory::findOrFail($categoryId);

        $posts = Post::where('post_category_id', $categoryId)
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                    'image' => $post->image ? asset('storage/' . $post->image) : null,
                    'category_id' => $post->post_category_id,
                    'category_name' => $post->category->name,
                    'created_at' => $post->created_at->format('Y-m-d H:i:s')
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => [
                'category' => [
                    'id' => $category->id,
                    'name' => $category->name
                ],
                'posts' => $posts
            ]
        ]);
    }

    public function show($id)
    {
        $post = Post::where('is_active', true)
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'image' => $post->image ? asset('storage/' . $post->image) : null,
                'category_id' => $post->post_category_id,
                'category_name' => $post->category->name,
                'created_at' => $post->created_at->format('Y-m-d H:i:s')
            ]
        ]);
    }

    public function index($categoryId)
    {
        $category = PostCategory::findOrFail($categoryId);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $category->id,
                'name' => $category->name,
                'posts' => $category->posts()
                    ->where('is_active', true)
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->map(function ($post) {
                        return [
                            'id' => $post->id,
                            'title' => $post->title
                        ];
                    })
            ]
        ]);
    }
}
