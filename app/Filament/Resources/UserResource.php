<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = '系統設定';

    protected static ?string $navigationLabel = '管理者帳號';

    protected static ?string $modelLabel = '管理者帳號';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('名稱')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('password')
                            ->label('密碼')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create')
                            ->minLength(8)
                            ->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/')
                            ->rules(['min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'])
                            ->validationMessages([
                                'regex' => '密碼必須包含至少一個大寫字母、一個小寫字母和一個數字',
                            ])
                            ->helperText('密碼必須至少8個字元，包含大小寫字母和數字'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('名稱')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('建立時間')
                    ->dateTime('Y-m-d H:i:s')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (DeleteAction $action, Model $record) {
                        if ($record->email === 'admin@admin.com') {
                            $action->cancel();
                            return;
                        }
                    })
                    ->failureNotification(
                        fn(Model $record) =>
                        $record->email === 'admin@admin.com'
                            ? '系統管理員帳號不能刪除'
                            : null
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($action, Collection $records) {
                            $records = $records->reject(function ($record) {
                                return $record->email === 'admin@admin.com';
                            });

                            if ($records->isEmpty()) {
                                $action->cancel();
                                return;
                            }

                            $action->records($records);
                        })
                        ->failureNotification('系統管理員帳號不能刪除'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
