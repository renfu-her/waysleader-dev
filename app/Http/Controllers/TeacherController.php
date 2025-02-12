<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TeacherController extends Controller
{
    public function index()
    {
        $response = Http::get(config('app.api_url') . '/api/v1/teachers');
        
        if (!$response->successful()) {
            abort(404);
        }

        $teachers = $response->json()['data'];
        
        return view('teachers.index', compact('teachers'));
    }

    public function show($id)
    {
        $response = Http::get(config('app.api_url') . "/api/v1/teachers/{$id}");
        
        if (!$response->successful()) {
            abort(404);
        }

        $teacher = $response->json()['data'];
        
        return view('teachers.show', compact('teacher'));
    }
} 