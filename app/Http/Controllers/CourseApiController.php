<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseApiController extends Controller
{
    // 課程列表
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);

        $courses = Course::query()
            ->with('images')
            ->where('is_active', true)
            ->orderByDesc('created_at')
            ->paginate($perPage);

        return response()->json([
            'data' => $courses->map(function ($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'subtitle' => $course->subtitle,
                    'image_url' => $course->image_url,
                    'is_new' => $course->is_new,
                    'created_at' => $course->created_at,
                    'images' => $course->images->map->only(['image_url', 'sort'])
                ];
            }),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'total' => $courses->total(),
                'per_page' => $courses->perPage(),
            ]
        ]);
    }

    // 單個課程詳情
    public function show(Course $course)
    {
        $course->load('images');

        return response()->json([
            'data' => [
                'id' => $course->id,
                'title' => $course->title,
                'subtitle' => $course->subtitle,
                'content' => $course->content,
                'image_url' => $course->image_url,
                'is_new' => $course->is_new,
                'created_at' => $course->created_at,
                'images' => $course->images->map(function ($image) {
                    return [
                        'image_url' => $image->image_url,
                        'sort' => $image->sort
                    ];
                })
            ]
        ]);
    }
}
