<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FaqController extends Controller
{
    public function index()
    {
        $response = Http::get(config('app.api_url') . '/api/v1/faqs');
        
        if (!$response->successful()) {
            abort(404);
        }

        $faqs = $response->json()['data'];
        
        return view('faqs.index', compact('faqs'));
    }
} 