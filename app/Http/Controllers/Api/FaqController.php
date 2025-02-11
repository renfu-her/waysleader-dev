<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('is_active', true)
            ->orderBy('sort')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => FaqResource::collection($faqs)
        ]);
    }
} 