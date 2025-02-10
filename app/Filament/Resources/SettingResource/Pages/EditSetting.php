<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    /**
     * 覆寫 mount 方法，使 $record 參數變爲可選。
     */
    public function mount($record = null): void
    {
        if (empty($record)) {
            // 如果沒有傳入記錄 ID，則取得現有設定，若無則自動建立一筆預設記錄
            $setting = Setting::first();
            if (! $setting) {
                $setting = Setting::create([
                    'site_name' => config('app.name'),
                    // 可依需求補上其他預設值
                ]);
            }
            $record = $setting->getKey();
        }

        parent::mount($record);
    }

    public function getRecord(): Model
    {
        // 此處直接返回唯一的設定記錄
        return Setting::first();
    }

    protected function getHeaderActions(): array
    {
        // 不需要其他動作按鈕
        return [];
    }

    protected function afterSave(): void
    {
        // 如果有設定快取，可在此處清除
        cache()->forget('site-settings');
    }
}
