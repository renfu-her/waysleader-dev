<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SinglePageResource;
use App\Models\SinglePage;
use Illuminate\Http\Request;

class SinglePageController extends Controller
{
    // 獲取所有啟用的單頁列表
    public function index()
    {
        $pages = SinglePage::where('is_active', true)
            ->orderBy('sort')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => SinglePageResource::collection($pages)
        ]);
    }

    // 獲取單個頁面詳情
    public function show($slug)
    {
        $page = SinglePage::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data' => new SinglePageResource($page)
        ]);
    }
}
