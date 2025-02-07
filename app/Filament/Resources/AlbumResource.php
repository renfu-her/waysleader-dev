<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlbumResource\Pages;
use App\Filament\Resources\AlbumResource\RelationManagers;
use App\Models\Album;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Repeater;

class AlbumResource extends Resource
{
    protected static ?string $model = Album::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = '網站管理';

    protected static ?string $navigationLabel = '相簿管理';

    protected static ?string $pluralModelLabel = '相簿列表';

    protected static ?string $pluralLabel = '相簿列表';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $createButtonLabel = '新增相簿';

    protected static ?string $editButtonLabel = '編輯相簿';

    protected static ?string $deleteButtonLabel = '刪除相簿';

    protected static ?string $modelLabel = '相簿';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('標題')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->label('封面圖片')
                    ->image()
                    ->imageEditor()
                    ->directory('albums')
                    ->columnSpanFull()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->imageResizeMode('cover')
                    ->imageResizeTargetWidth('1024')
                    ->imageResizeTargetHeight('1024')
                    ->saveUploadedFileUsing(function ($file) {
                        $manager = new ImageManager(new Driver());
                        $image = $manager->read($file);
                        $image->cover(1024, 1024);
                        $filename = Str::uuid()->toString() . '.webp';
                        if (!file_exists(storage_path('app/public/albums'))) {
                            mkdir(storage_path('app/public/albums'), 0755, true);
                        }
                        $image->toWebp(80)->save(storage_path('app/public/albums/' . $filename));
                        return 'albums/' . $filename;
                    }),
                Forms\Components\TextInput::make('content')
                    ->label('描述')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->label('啟用')
                    ->default(true)
                    ->inline(false),
                Forms\Components\Section::make('相簿圖片')
                    ->schema([
                        Forms\Components\FileUpload::make('album_images')
                            ->label('上傳多張圖片')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->reorderable()
                            ->directory('album-images')
                            ->columnSpanFull()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->saveUploadedFileUsing(function ($file) {
                                $manager = new ImageManager(new Driver());
                                $image = $manager->read($file);
                                $image->cover(1024, 1024);
                                $filename = Str::uuid7()->toString() . '.webp';
                                if (!file_exists(storage_path('app/public/album-images'))) {
                                    mkdir(storage_path('app/public/album-images'), 0755, true);
                                }
                                $image->toWebp(80)->save(storage_path('app/public/album-images/' . $filename));
                                return 'album-images/' . $filename;
                            })
                            ->saveRelationshipsUsing(function ($record, $state) {
                                foreach ($state as $index => $image) {
                                    $record->images()->create([
                                        'image' => $image,
                                        'sort' => $index
                                    ]);
                                }
                            }),
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
                Tables\Columns\TextColumn::make('content')
                    ->label('描述')
                    ->limit(50),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('啟用狀態')
                    ->onColor('success')
                    ->offColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('建立時間')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('更新時間')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
            RelationManagers\ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlbums::route('/'),
            'create' => Pages\CreateAlbum::route('/create'),
            'edit' => Pages\EditAlbum::route('/{record}/edit'),
        ];
    }
}
