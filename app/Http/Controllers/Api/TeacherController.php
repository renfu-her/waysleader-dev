<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::where('is_active', true)
            ->orderBy('sort')
            ->get()
            ->map(function ($teacher) {
                return [
                    'id' => $teacher->id,
                    'title' => $teacher->title,
                    'name' => $teacher->name,
                    'content' => $teacher->content,
                    'image_url' => $teacher->image ? asset('storage/' . $teacher->image) : null,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $teachers
        ]);
    }

    public function show($id)
    {
        $teacher = Teacher::where('is_active', true)
            ->findOrFail($id);

        $data = [
            'id' => $teacher->id,
            'title' => $teacher->title,
            'name' => $teacher->name,
            'content' => $teacher->content,
            'image_url' => $teacher->image ? url($teacher->image) : null,
        ];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
} 