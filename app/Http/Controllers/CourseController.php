<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    public function index()
    {
        $response = Http::get(config('app.api_url') . '/api/v1/courses');
        
        if (!$response->successful()) {
            abort(404);
        }

        $courses = $response->json()['data'];
        
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $response = Http::get(config('app.api_url') . "/api/v1/courses/{$id}");
        
        if (!$response->successful()) {
            abort(404);
        }

        $course = $response->json()['data'];
        
        return view('courses.show', compact('course'));
    }
} 