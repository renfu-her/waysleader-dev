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

        if (! $setting) {
            // 若設定不存在，回傳 status 為 false 並傳入錯誤 message 及 404 HTTP 狀態碼
            return response()->json([
                'status'  => 'fail',
                'data'    => null,
                'message' => '尚未建立站台設定',
            ], 404);
        }

        // 若設定存在，回傳 status 為 true 與該筆資料
        return response()->json([
            'status' => 'success',
            'data'   => $setting,
        ]);

    }
}
