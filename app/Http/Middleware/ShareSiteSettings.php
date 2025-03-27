<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use App\Models\SinglePage;

class ShareSiteSettings
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $apiUrl = config('app.api_url');
            Log::info('API URL: ' . $apiUrl);

            $response = Http::get($apiUrl . '/api/v1/setting');
            Log::info('API Response: ' . json_encode($response->json()));
            
            if ($response->successful()) {
                $settings = (object)$response->json()['data'];
            } else {
                Log::warning('API request failed: ' . $response->status());
                $settings = $this->getDefaultSettings();
            }
        } catch (\Exception $e) {
            Log::error('API request error: ' . $e->getMessage());
            $settings = $this->getDefaultSettings();
        }

        // 獲取所有啟用的課程頁面
        $coursePages = SinglePage::where('is_active', true)
            ->orderBy('sort', 'asc')
            ->get(['slug', 'title']);

        View::share('siteSettings', $settings);
        View::share('coursePages', $coursePages);
        
        return $next($request);
    }

    private function getDefaultSettings()
    {
        return (object)[
            'site_name' => '科普班長',
            'site_logo' => null,
            'site_favicon' => null,
            'seo_title' => null,
            'seo_description' => null,
            'seo_keywords' => null,
            'contact_email' => null,
            'contact_phone' => null,
            'address' => null,
            'facebook_url' => null,
            'instagram_url' => null,
            'line_url' => null
        ];
    }
} 