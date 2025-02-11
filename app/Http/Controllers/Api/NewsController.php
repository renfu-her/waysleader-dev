<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('is_active', true)
            ->orderBy('sort')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'content' => $item->content,
                    'image' => $item->image ? asset('storage/news/' . $item->image) : null,
                    'is_new' => $item->is_new,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $news
        ]);
    }

    public function show($id)
    {
        $news = News::where('is_active', true)
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $news->id,
                'title' => $news->title,
                'content' => $news->content,
                'image' => $news->image ? asset('storage/news/' . $news->image) : null,
                'is_new' => $news->is_new,
            ]
        ]);
    }
}
