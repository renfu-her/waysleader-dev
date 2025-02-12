<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AchievementController extends Controller
{
    public function index()
    {
        return redirect()->route('achievements.category', 'creative');
    }

    public function category($slug)
    {
        $response = Http::get(config('app.api_url') . "/api/v1/achievement-categories/{$slug}/achievements");
        
        if (!$response->successful()) {
            abort(404);
        }

        $data = $response->json()['data'];
        
        return view('achievements.category', [
            'category' => $data['category'],
            'achievements' => $data['achievements']
        ]);
    }

    public function show($id)
    {
        $response = Http::get(config('app.api_url') . "/api/v1/achievements/{$id}");
        
        if (!$response->successful()) {
            abort(404);
        }

        $achievement = $response->json()['data'];
        
        return view('achievements.show', compact('achievement'));
    }
} 