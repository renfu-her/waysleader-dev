<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * 透過 GET 方式取得唯一一筆網站設定
     */
    public function index()
    {
        $setting = Setting::first();

        if (!$setting) {
            // 若設定不存在，回傳 status 為 false 並傳入錯誤 message 及 404 HTTP 狀態碼
            return response()->json([
                'status'  => 'fail',
                'data'    => null,
                'message' => '尚未建立站台設定',
            ], 404);

        }

        // 將 Setting 模型轉成陣列，再使用 asset() 輸出完整網址
        $data = $setting->toArray();
        $data['site_logo']    = $setting->site_logo ? asset('storage/' . $setting->site_logo) : null;
        $data['site_favicon'] = $setting->site_favicon ? asset('storage/' . $setting->site_favicon) : null;

        // 回傳狀態與資料
        return response()->json([
            'status' => 'success',
            'data'   => $data,
        ]);

    }
}
