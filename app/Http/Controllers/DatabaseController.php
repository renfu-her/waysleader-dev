<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class DatabaseController extends Controller
{
    public function checkConnection()
    {
        try {
            DB::connection()->getPdo();
            $dbStatus = [
                'status' => true,
                'message' => '資料庫連線成功',
                'database' => DB::connection()->getDatabaseName(),
                'host' => Config::get('database.connections.' . Config::get('database.default') . '.host'),
                'username' => Config::get('database.connections.' . Config::get('database.default') . '.username'),
                'password' => Config::get('database.connections.' . Config::get('database.default') . '.password'),
            ];
        } catch (\Exception $e) {
            $dbStatus = [
                'status' => false,
                'message' => '資料庫連線失敗: ' . $e->getMessage(),
                'host' => Config::get('database.connections.' . Config::get('database.default') . '.host'),
                'username' => Config::get('database.connections.' . Config::get('database.default') . '.username'),
                'password' => '******' // 為了安全考慮，不直接顯示密碼
            ];
        }

        return view('database-status', compact('dbStatus'));
    }
}
