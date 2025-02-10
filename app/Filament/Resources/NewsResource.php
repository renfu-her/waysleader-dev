<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = '網站管理';

    protected static ?string $navigationLabel = '最新消息';

    protected static ?string $pluralModelLabel = '最新消息列表';

    protected static ?string $pluralLabel = '最新消息列表';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $createButtonLabel = '新增最新消息';

    protected static ?string $editButtonLabel = '編輯最新消息';

    protected static ?string $deleteButtonLabel = '刪除最新消息';

    protected static ?string $modelLabel = '最新消息';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('標題')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->label('圖片')
                    ->image()
                    ->imageEditor()
                    ->directory('news')
                    ->columnSpanFull()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->downloadable()
                    ->openable()
                    ->getUploadedFileNameForStorageUsing(
                        fn($file): string => (string) str(Str::uuid7() . '.webp')
                    )
                    ->saveUploadedFileUsing(function ($file) {
                        $manager = new ImageManager(new Driver());
                        $image = $manager->read($file);
                        $image->cover(1024, 1024);
                        $filename = Str::uuid7()->toString() . '.webp';

                        if (!file_exists(storage_path('app/public/news'))) {
                            mkdir(storage_path('app/public/news'), 0755, true);
                        }

                        $image->toWebp(80)->save(storage_path('app/public/news/' . $filename));
                        return 'news/' . $filename;
                    })
                    ->deleteUploadedFileUsing(function ($file) {
                        if ($file) {
                            Storage::disk('public')->delete($file);
                        }
                    }),
                TinyEditor::make('content')
                    ->label('內容')
                    ->columnSpanFull()
                    ->required()
                    ->maxHeight(500)
                    ->minHeight(500),
                Forms\Components\Toggle::make('is_active')
                    ->label('啟用')
                    ->default(true)
                    ->inline(false),
                Forms\Components\Toggle::make('is_new')
                    ->label('最新')
                    ->default(true)
                    ->inline(false),

                Forms\Components\Section::make('SEO 設定')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('SEO 標題')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('meta_description')
                            ->label('SEO 描述')
                            ->rows(3)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('meta_keywords')
                            ->label('SEO 關鍵字')
                            ->maxLength(255)
                            ->placeholder('關鍵字之間請用逗號分隔'),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('標題')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('圖片')
                    ->defaultImageUrl(url('/images/no-image.png'))
                    ->visibility(fn($record) => $record->image !== null),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('啟用狀態')
                    ->onColor('success')
                    ->offColor('danger'),
                Tables\Columns\ToggleColumn::make('is_new')
                    ->label('最新')
                    ->onColor('success')
                    ->offColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('啟用狀態'),
                Tables\Filters\TernaryFilter::make('is_new')
                    ->label('最新'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
