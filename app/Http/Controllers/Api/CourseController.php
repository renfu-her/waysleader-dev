<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        try {
            $courses = Course::where('is_active', true)
                ->select([
                    'id',
                    'title',
                    'subtitle',
                    'image',
                    'is_new',
                    'created_at'
                ])
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($course) {
                    return [
                        'id'         => $course->id,
                        'title'      => $course->title,
                        'image_url'  => $course->image ? asset('storage/' . $course->image) : null,
                        'is_new'     => $course->is_new,
                        'created_at' => $course->created_at->format('Y-m-d H:i:s'),
                    ];
                });

            return response()->json([
                'status' => 'success',
                'data'   => $courses,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'fail',
                'message' => '獲取課程列表失敗'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
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

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'fail',
                'message' => '找不到該課程'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => '獲取課程詳情失敗'
            ], 500);
        }
    }
}
