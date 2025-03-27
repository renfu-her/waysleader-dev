<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SinglePage;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function show($slug)
    {

        $page = SinglePage::where('slug', $slug)->first();

        if (empty($page)) {
            abort(404);
        }

        return view('pages.show', compact('page'));
    }
} 