<?php

namespace App\Filament\Resources\AlbumResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $recordTitleAttribute = 'image';

    protected static ?string $title = '相簿圖片';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('圖片')
                    ->multiple()
                    ->image()
                    ->imageEditor()
                    ->directory('album-images')
                    ->columnSpanFull()
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->imageResizeMode('cover')

                    ->imageResizeTargetWidth('1024')
                    ->imageResizeTargetHeight('1024')
                    ->saveUploadedFileUsing(function ($file) {
                        $manager = new ImageManager(new Driver());
                        $image = $manager->read($file);
                        $image->cover(1024, 1024);
                        $filename = Str::uuid()->toString() . '.webp';
                        if (!file_exists(storage_path('app/public/album-images'))) {
                            mkdir(storage_path('app/public/album-images'), 0755, true);
                        }
                        $image->toWebp(80)->save(storage_path('app/public/album-images/' . $filename));
                        return 'album-images/' . $filename;
                    }),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('image')
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('圖片'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('上傳時間')
                    ->dateTime('Y-m-d H:i:s')
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('新增圖片'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('sort')
            ->defaultSort('sort');
    }
}
