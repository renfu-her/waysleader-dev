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
                'is_new',
                'course_category_id',
            ])
            ->with('category:id,name')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'image_url' => $course->image ? asset('storage/' . $course->image) : null,
                    'is_new' => $course->is_new,
                    'category' => $course->category ? $course->category->name : null,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $courses,
        ]);
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
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
