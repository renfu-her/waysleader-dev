<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static ?string $navigationGroup = '系統設定';
    protected static ?string $navigationLabel = '網站設定';
    protected static ?string $modelLabel = '網站設定';
    // 僅用單一筆記錄，故不需列表頁與新增功能
    protected static ?int $navigationSort = 100;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('site_name')
                ->label('網站名稱')
                ->required(),
            Forms\Components\FileUpload::make('site_logo')
                ->label('網站 Logo')
                ->image()
                ->directory('settings')
                ->visibility('public'),
            Forms\Components\FileUpload::make('site_favicon')
                ->label('網站 Favicon')
                ->image()
                ->directory('settings')
                ->visibility('public'),
            Forms\Components\TextInput::make('seo_title')
                ->label('SEO 標題'),
            Forms\Components\Textarea::make('seo_description')
                ->label('SEO 描述'),
            Forms\Components\TextInput::make('seo_keywords')
                ->label('SEO 關鍵字'),
            Forms\Components\TextInput::make('contact_email')
                ->label('聯絡信箱')
                ->email(),
            Forms\Components\TextInput::make('contact_phone')
                ->label('聯絡電話'),
            Forms\Components\Textarea::make('address')
                ->label('地址'),
            Forms\Components\TextInput::make('facebook_url')
                ->label('Facebook 連結')
                ->url(),
            Forms\Components\TextInput::make('instagram_url')
                ->label('Instagram 連結')
                ->url(),
            Forms\Components\TextInput::make('line_url')
                ->label('Line 連結')
                ->url(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            // 直接設定 index 為編輯頁面
            'index' => Pages\EditSetting::route('/'),
        ];
    }
}
