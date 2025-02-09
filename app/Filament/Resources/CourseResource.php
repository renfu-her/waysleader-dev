<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use League\Glide\Server;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = '網站管理';

    protected static ?string $navigationLabel = '教育課程';

    protected static ?string $pluralLabel = '教育課程';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $createButtonLabel = '新增課程';

    protected static ?string $editButtonLabel = '編輯課程';

    protected static ?string $deleteButtonLabel = '刪除課程';

    protected static ?string $modelLabel = '教育課程';

    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('標題')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('subtitle')
                            ->label('次標題')
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('image')
                            ->label('主要圖片')
                            ->image()
                            ->imageEditor()
                            ->directory('course-main-images')
                            ->columnSpanFull()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->saveUploadedFileUsing(function ($file) {
                                $manager = new ImageManager(new Driver());
                                $image = $manager->read($file);
                                $image->cover(1024, 1024);
                                $filename = Str::uuid7()->toString() . '.webp';
                                if (!file_exists(storage_path('app/public/course-main-images'))) {
                                    mkdir(storage_path('app/public/course-main-images'), 0755, true);
                                }
                                $image->toWebp(80)->save(storage_path('app/public/course-main-images/' . $filename));
                                return 'course-main-images/' . $filename;
                            }),

                        TinyEditor::make('content')
                            ->label('內容')
                            ->columnSpanFull()
                            ->required()
                            ->maxHeight(500)
                            ->minHeight(500),

                        Forms\Components\Toggle::make('is_active')
                            ->label('啟用')
                            ->default(true),

                        Forms\Components\Toggle::make('is_new')
                            ->label('新課程')
                            ->default(false),
                    ]),

                Forms\Components\Section::make('課程圖片')
                    ->schema([
                        Forms\Components\FileUpload::make('course_images')
                            ->label('上傳多張圖片')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->reorderable()
                            ->directory('course-images')
                            ->columnSpanFull()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->downloadable()
                            ->openable()
                            ->getUploadedFileNameForStorageUsing(
                                fn($file): string => (string) str(Str::uuid7()->toString() . '.webp')
                            )
                            ->saveUploadedFileUsing(function ($file) {
                                $manager = new ImageManager(new Driver());
                                $image = $manager->read($file);
                                $image->cover(1024, 1024);
                                $filename = Str::uuid7()->toString() . '.webp';

                                if (!file_exists(storage_path('app/public/course-images'))) {
                                    mkdir(storage_path('app/public/course-images'), 0755, true);
                                }

                                $image->toWebp(80)->save(storage_path('app/public/course-images/' . $filename));
                                return 'course-images/' . $filename;
                            })
                            ->deleteUploadedFileUsing(function ($file) {
                                Storage::disk('public')->delete($file);
                            })
                            ->saveRelationshipsUsing(function ($record, $state) {
                                // 刪除現有圖片關聯
                                $record->images()->delete();

                                // 如果有新的圖片，建立新的關聯
                                if ($state) {
                                    foreach ($state as $index => $image) {
                                        $record->images()->create([
                                            'image' => $image,
                                            'sort' => $index + 1
                                        ]);
                                    }
                                }
                            })
                            ->dehydrated(fn($state) => filled($state))
                            ->visible(fn($record) => $record === null || $record->exists)
                            ->loadStateFromRelationshipsUsing(function (FileUpload $component, $record) {
                                // 載入現有圖片
                                $component->state(
                                    $record->images()
                                        ->orderBy('sort')
                                        ->pluck('image')
                                        ->toArray()
                                );
                            }),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('主要圖片')
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->label('標題')
                    ->searchable(),

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('次標題')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('啟用')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_new')
                    ->label('新課程')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('建立時間')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
