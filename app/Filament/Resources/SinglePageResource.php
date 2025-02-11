<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SinglePageResource\Pages;
use App\Models\SinglePage;
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

class SinglePageResource extends Resource
{
    protected static ?string $model = SinglePage::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = '網站管理';

    protected static ?string $navigationLabel = '單一頁面';

    protected static ?string $pluralModelLabel = '單一頁面列表';

    protected static ?string $pluralLabel = '單一頁面列表';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $modelLabel = '單一頁面';

    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('標題')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug (別名)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->label('圖片')
                    ->image()
                    ->imageEditor()
                    ->directory('single-pages')
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

                        if (!file_exists(storage_path('app/public/single-pages'))) {
                            mkdir(storage_path('app/public/single-pages'), 0755, true);
                        }

                        $image->toWebp(80)->save(storage_path('app/public/single-pages/' . $filename));
                        return 'single-pages/' . $filename;
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
                    ->label('啟用狀態')
                    ->default(true)
                    ->inline(false),

                Forms\Components\TextInput::make('sort')
                    ->label('排序')
                    ->default(0)
                    ->numeric(),

                Forms\Components\Section::make('SEO 設定')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('SEO 標題')
                            ->maxLength(255)
                            ->default(fn(Forms\Get $get) => $get('title')),

                        Forms\Components\Textarea::make('meta_description')
                            ->label('SEO 描述')
                            ->rows(3)
                            ->maxLength(255)
                            ->default(fn(Forms\Get $get) => strip_tags($get('content'))),

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
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('圖片')
                    ->defaultImageUrl(url('/images/no-image.png'))
                    ->visibility(fn($record) => $record->image !== null),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('最後更新')
                    ->dateTime(),
            ])
            ->defaultSort('sort', 'asc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('啟用狀態'),
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
            'index' => Pages\ListSinglePages::route('/'),
            'create' => Pages\CreateSinglePage::route('/create'),
            'edit' => Pages\EditSinglePage::route('/{record}/edit'),
        ];
    }
}
