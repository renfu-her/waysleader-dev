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

                        Forms\Components\Textarea::make('subtitle')
                            ->label('次標題')
                            ->rows(3)
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->label('主要圖片')
                            ->image()
                            ->imageEditor()
                            ->directory('course-main-images')
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

                                if (!file_exists(storage_path('app/public/courses'))) {
                                    mkdir(storage_path('app/public/courses'), 0755, true);
                                }
                                $image->toWebp(80)->save(storage_path('app/public/courses/' . $filename));
                                return 'courses/' . $filename;
                            })

                            ->deleteUploadedFileUsing(function ($file) {
                                if ($file) {
                                    Storage::disk('public')->delete($file);
                                }
                            }),

                        TinyEditor::make('content')
                            ->label('內容')
                            ->required()
                            ->columnSpanFull()
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
                                fn($file): string => (string) str(Str::uuid7() . '.webp')
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
                                if ($file) {
                                    Storage::disk('public')->delete($file);
                                }
                            })
                            ->saveRelationshipsUsing(function ($record, $state) {
                                // 獲取現有圖片
                                $existingImages = $record->images()->pluck('image')->toArray();

                                // 找出需要刪除的舊圖片
                                $removedImages = array_diff($existingImages, $state ?? []);
                                foreach ($removedImages as $image) {
                                    Storage::disk('public')->delete($image);
                                }

                                // 刪除資料庫中不存在的關聯
                                $record->images()->whereNotIn('image', $state ?? [])->delete();

                                // 新增或更新現有關聯
                                collect($state ?? [])->each(function ($image, $index) use ($record) {
                                    $record->images()->updateOrCreate(
                                        ['image' => $image],
                                    );
                                });
                            })
                            ->loadStateFromRelationshipsUsing(function (FileUpload $component, $record) {
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
                    ->searchable()
                    ->wrap()
                    ->html(),

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
