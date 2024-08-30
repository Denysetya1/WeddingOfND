<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use illuminate\Support\Str;
use Rawilk\FilamentPasswordInput\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'List Akun';
    protected static ?string $slug = 'list-user';
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pelanggan')
                    ->description('Isi Secara Benar')
                    ->aside()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->live(onBlur: true)->required()->minLength(3)
                            ->required(),
                        TextInput::make('pernikahan')
                            ->label('Pernikahan Mempelai')
                            ->helperText('Contoh: Fulan dan Fulana')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (String $operation, $state, Set $set, User $user) {
                                if($operation === 'edit' ){
                                    if($user['slug'] !== null)
                                    {
                                        return;
                                    }
                                }
                                $slug = Str::slug($state);
                                $cek = User::where('slug', $slug)->first();
                                if($cek) {
                                    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                    $charactersNumber = strlen($characters);

                                    $code = '';

                                    while (strlen($code) < 3) {
                                        $position = rand(0, $charactersNumber - 1);
                                        $character = $characters[$position];
                                        $code = $code.$character;
                                    }
                                    $slug = $slug.'-'.$code;
                                }
                                $set('slug', $slug);
                            })
                            ->required(),
                        TextInput::make('phone')
                            ->label('No. WA')
                            ->numeric()
                            ->helperText('Gunakan awalan 0, Contoh: 08xxxxxxxxxx')
                            ->required(),
                    ]),
                Section::make('Informasi Akun')
                    ->description('Isi Secara Benar')
                    ->aside()
                    ->schema([
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->columnspan(2),
                        Password::make('password')
                            ->label('Password')
                            ->columnspan(2)
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord)
                            ->showPasswordText('Show password')
                            ->hidePasswordText('Hide password')
                            ->copyable()
                            ->copyIconColor('sky')
                            ->copyMessage('Dicopy'),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->visible(function (){
                                if (auth()->user()->isAdmin()) {
                                    return true;
                                } else {
                                    return false    ;
                                }
                            }),
                        Select::make('roles')->relationship('roles', 'name')->native(false)->required()
                        ->columnspan(function (){
                            if (auth()->user()->isAdmin()) {
                                return 1;
                            } else {
                                return 2;
                            }
                        }),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama Lengkap'),
                TextColumn::make('pernikahan')->label('Mempelai'),
                TextColumn::make('email')->label('Email')
                ->icon('heroicon-m-envelope'),
                TextColumn::make('slug')->label('Slug'),
                TextColumn::make('roles.name')->label('Role')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'admin' => 'success',
                    'pelanggan' => 'link',
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->color('warning'),
                Tables\Actions\DeleteAction::make()
                    ->color('danger')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Berhasil Terhapus')
                            ->body('Tamu Undangan Behasil Dihapus.'),
                    )
                    ->visible(function (User $records){
                        if ($records->isAdmin()) {
                            return false;
                        } else {
                            return true;
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->recordUrl(null)->deferLoading();
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
