<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('images')
            ->where('is_active', true)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($album) {
                return [
                    'id' => $album->id,
                    'title' => $album->title,
                    'content' => $album->content,
                    'cover' => $album->image ? asset('storage/' . $album->image) : null,
                    'images' => $album->images->map(function ($image) {
                        return [
                            'id' => $image->id,
                            'url' => asset('storage/' . $image->image),
                            'sort' => $image->sort
                        ];
                    }),
                    'created_at' => $album->created_at->format('Y-m-d H:i:s')
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $albums
        ]);
    }

    public function show($id)
    {
        $album = Album::with('images')
            ->where('is_active', true)
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $album->id,
                'title' => $album->title,
                'content' => $album->content,
                'cover' => $album->image ? asset('storage/' . $album->image) : null,
                'images' => $album->images->map(function ($image) {
                    return [
                        'id' => $image->id,
                        'url' => asset('storage/' . $image->image),
                        'sort' => $image->sort
                    ];
                }),
                'created_at' => $album->created_at->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
