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
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $recordTitleAttribute = 'image';

    protected static ?string $title = '相簿圖片';

    protected static ?string $modelLabel = '相簿圖片';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('image')
                ->label('上傳相簿圖片')
                ->image()
                ->columnSpanFull()
                ->imageEditor()
                ->directory('albums')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->downloadable()
                ->openable()
                ->reorderable()
                ->getUploadedFileNameForStorageUsing(fn($file): string => (string) Str::uuid7() . '.webp')
                ->saveUploadedFileUsing(function ($file) {
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($file);
                    $image->cover(1024, 1024);
                    $filename = Str::uuid7()->toString() . '.webp';

                    if (!file_exists(storage_path('app/public/albums'))) {
                        mkdir(storage_path('app/public/albums'), 0755, true);
                    }

                    $image->toWebp(80)->save(storage_path('app/public/albums/' . $filename));
                    return 'albums/' . $filename;
                })
                ->deleteUploadedFileUsing(function ($file) {
                    if ($file) {
                        Storage::disk('public')->delete($file);
                    }
                })
                ->saveRelationshipsUsing(function (Model $record, $state) {
                    // 確保 $state 為陣列
                    $files = collect($state ?? [])->values()->toArray();

                    if (empty($files)) {
                        // 如果沒有檔案，直接刪除當前記錄
                        Storage::disk('public')->delete($record->image);
                        $record->delete();
                        return;
                    }

                    // 更新圖片路徑
                    $record->update([
                        'image' => $files[0], // 因為是單一圖片，取第一個
                    ]);
                }),
            Forms\Components\TextInput::make('sort')
                ->label('排序')
                ->default(1)
                ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('image')
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('相簿圖片'),
                Tables\Columns\TextColumn::make('sort')
                    ->label('排序')
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
            ->defaultSort('sort', 'asc')
            ->reorderable('sort');
    }
}
