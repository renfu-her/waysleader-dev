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
use App\Filament\Resources\CourseResource\RelationManagers\ImagesRelationManager;
use Filament\Tables\Columns\ToggleColumn;

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
                            ->default(true)
                            ->inline(false),

                        Forms\Components\Toggle::make('is_new')
                            ->label('新課程')
                            ->default(false)
                            ->inline(false),
                    ]),

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
                            ->default(fn(Forms\Get $get) => strip_tags($get('subtitle'))),

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

                ToggleColumn::make('is_active')
                    ->label('啟用')
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle')
                    ->action(function ($record, $state) {
                        $record->update(['is_active' => $state]);
                    }),
                ToggleColumn::make('is_new')
                    ->label('新課程')
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle')
                    ->action(function ($record, $state) {
                        $record->update(['is_new' => $state]);
                    }),

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
            ImagesRelationManager::class,
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
