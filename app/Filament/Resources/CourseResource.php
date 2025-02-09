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

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = '教育課程';

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

                        Forms\Components\RichEditor::make('content')
                            ->label('內容')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('啟用')
                            ->default(true)
                            ->inline(false),

                        Forms\Components\Toggle::make('is_new')
                            ->label('新課程')
                            ->default(false)
                            ->inline(false),

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
                            ->saveRelationshipsUsing(function ($record, $state) {
                                $record->images()->delete();
                                foreach ($state as $index => $image) {
                                    $record->images()->create([
                                        'image' => $image,
                                        'sort' => $index + 1
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
