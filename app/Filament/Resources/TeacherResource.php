<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $modelLabel = '師資';

    protected static ?string $pluralModelLabel = '團隊師資';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('職稱')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('name')
                            ->label('姓名')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('sex')
                            ->label('性別')
                            ->options([
                                'male' => '男',
                                'female' => '女',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('mobile')
                            ->label('手機')
                            ->tel()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('address')
                            ->label('地址')
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('image')
                            ->label('照片')
                            ->image()
                            ->directory('teachers')
                            ->preserveFilenames()
                            ->maxSize(5120)
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('content')
                            ->label('介紹內容')
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('啟用')
                            ->default(true),

                        Forms\Components\TextInput::make('sort')
                            ->label('排序')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('照片')
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('職稱')
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('姓名')
                    ->searchable(),

                Tables\Columns\TextColumn::make('sex')
                    ->label('性別')
                    ->formatStateUsing(fn(string $state): string => $state === 'male' ? '男' : '女'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('啟用')
                    ->boolean(),

                Tables\Columns\TextColumn::make('sort')
                    ->label('排序')
                    ->sortable(),

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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort', 'asc');
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
