<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function show($slug)
    {
        $response = Http::get(config('app.api_url') . "/api/v1/pages/{$slug}");
        
        if (!$response->successful()) {
            abort(404);
        }

        $page = $response->json()['data'];
        
        return view('pages.show', compact('page'));
    }
} 