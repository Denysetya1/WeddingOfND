<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddinggiftResource\Pages;
use App\Filament\Resources\WeddinggiftResource\RelationManagers;
use App\Models\User;
use App\Models\Weddinggift;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeddinggiftResource extends Resource
{
    protected static ?string $model = Weddinggift::class;
    protected static ?string $navigationLabel = 'Wedding Gift';
    protected static ?string $slug = 'wedding-gift';
    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $activeNavigationIcon = 'heroicon-m-gift-top';
    protected static ?string $navigationGroup = 'Pengaturan Undangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->native(false)
                    ->label('Pelanggan')
                    ->searchable()
                    ->preload()
                    ->getSearchResultsUsing(fn (string $search): array => User::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                    ->getOptionLabelUsing(fn ($value): ?string => User::find($value)?->name)
                    ->visible(function (){
                        if (auth()->user()->isAdmin()) {
                            return true;
                        } else {
                            return false    ;
                        }
                    })
                    ->required(),
                Forms\Components\TextInput::make('bank_name')
                    ->label('Nama Bank')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_rek')
                    ->label('Nomor Rekening')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_rek')
                    ->label('Atas Nama Pemilik Rekening')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bank_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_rek')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_rek')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->color('warning'),
                Tables\Actions\DeleteAction::make()
                ,
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
            'index' => Pages\ListWeddinggifts::route('/'),
            'create' => Pages\CreateWeddinggift::route('/create'),
            'edit' => Pages\EditWeddinggift::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        if(auth()->user()->hasPermissionTo('viewAll'))
        {
            return parent::getEloquentQuery();
        } else
        {
            return parent::getEloquentQuery()->where('user_id', auth()->id());
        }
    }
}
