<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', true)
            ->select([
                'id',
                'title',
                'subtitle',
                'image',
                'content',
                'is_new',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'created_at'
            ])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'subtitle' => $course->subtitle,
                    'image_url' => $course->image_url,
                    'content' => $course->content,
                    'is_new' => $course->is_new,
                    'meta' => [
                        'title' => $course->meta_title,
                        'description' => $course->meta_description,
                        'keywords' => $course->meta_keywords,
                    ],
                    'created_at' => $course->created_at->format('Y-m-d H:i:s'),
                ];
            });

        return response()->json($courses);
    }

    public function show($id)
    {
        $course = Course::with('images')
            ->where('is_active', true)
            ->findOrFail($id);

        $data = [
            'id' => $course->id,
            'title' => $course->title,
            'subtitle' => $course->subtitle,
            'image_url' => $course->image_url,
            'content' => $course->content,
            'is_new' => $course->is_new,
            'meta' => [
                'title' => $course->meta_title,
                'description' => $course->meta_description,
                'keywords' => $course->meta_keywords,
            ],
            'images' => $course->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'image_url' => $image->image_url,
                    'sort' => $image->sort,
                ];
            }),
            'created_at' => $course->created_at->format('Y-m-d H:i:s'),
        ];

        return response()->json($data);
    }
}
