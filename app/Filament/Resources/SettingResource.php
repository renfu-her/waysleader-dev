<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = '網站設定';
    protected static ?string $modelLabel = '網站設定';
    protected static ?int $navigationSort = 100;

    // 修改這裡，指定正確的 slug
    protected static ?string $slug = 'settings';

    // 隱藏新增按鈕
    public static function canCreate(): bool
    {
        return false;
    }

    // 隱藏刪除按鈕
    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('設定')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('基本設定')
                            ->schema([
                                Forms\Components\TextInput::make('site_name')
                                    ->label('網站名稱')
                                    ->required(),
                                Forms\Components\FileUpload::make('site_logo')
                                    ->label('網站 Logo')
                                    ->image()
                                    ->directory('settings')
                                    ->visibility('public')
                                    ->imageResizeMode('contain')
                                    ->imageCropAspectRatio('3:1'),
                                Forms\Components\FileUpload::make('site_favicon')
                                    ->label('網站 Favicon')
                                    ->image()
                                    ->directory('settings')
                                    ->visibility('public'),
                            ]),
                        Forms\Components\Tabs\Tab::make('SEO 設定')
                            ->schema([
                                Forms\Components\TextInput::make('seo_title')
                                    ->label('SEO 標題')
                                    ->placeholder('預設使用網站名稱'),
                                Forms\Components\Textarea::make('seo_description')
                                    ->label('SEO 描述')
                                    ->rows(3),
                                Forms\Components\TextInput::make('seo_keywords')
                                    ->label('SEO 關鍵字')
                                    ->placeholder('以逗號分隔'),
                            ]),
                        Forms\Components\Tabs\Tab::make('聯絡資訊')
                            ->schema([
                                Forms\Components\TextInput::make('contact_email')
                                    ->label('聯絡信箱')
                                    ->email(),
                                Forms\Components\TextInput::make('contact_phone')
                                    ->label('聯絡電話'),
                                Forms\Components\Textarea::make('address')
                                    ->label('地址')
                                    ->rows(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('社群連結')
                            ->schema([
                                Forms\Components\TextInput::make('facebook_url')
                                    ->label('Facebook 連結')
                                    ->url(),
                                Forms\Components\TextInput::make('instagram_url')
                                    ->label('Instagram 連結')
                                    ->url(),
                                Forms\Components\TextInput::make('line_url')
                                    ->label('Line 連結')
                                    ->url(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site_name')
                    ->label('網站名稱'),
                Tables\Columns\ImageColumn::make('site_logo')
                    ->label('Logo'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('最後更新')
                    ->dateTime('Y-m-d H:i:s'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'edit' => Pages\EditSetting::route('/'),
        ];
    }
}
