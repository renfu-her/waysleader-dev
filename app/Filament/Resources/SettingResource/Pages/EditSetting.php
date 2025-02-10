<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    public function getRecord(): Model
    {
        return Setting::instance();
    }

    // 隱藏刪除按鈕
    protected function getHeaderActions(): array
    {
        return [];
    }

    // 添加這個方法來處理表單提交
    protected function afterSave(): void
    {
        cache()->forget('site-settings');
    }
}
