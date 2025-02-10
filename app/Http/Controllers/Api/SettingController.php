<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * 取得網站設定（唯一一筆記錄）
     */
    public function index()
    {
        $setting = Setting::first();

        if (! $setting) {
            // 若無設定則回傳錯誤訊息，你也可以改成自動建立預設記錄
            return response()->json(['message' => '尚未建立站台設定'], 404);
        }

        return response()->json(['data' => $setting]);
    }
}
