<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function checkConnection()
    {
        try {
            DB::connection()->getPdo();
            $dbStatus = [
                'status' => true,
                'message' => '資料庫連線成功',
                'database' => DB::connection()->getDatabaseName()
            ];
        } catch (\Exception $e) {
            $dbStatus = [
                'status' => false,
                'message' => '資料庫連線失敗: ' . $e->getMessage()
            ];
        }

        return view('database-status', compact('dbStatus'));
    }
}
