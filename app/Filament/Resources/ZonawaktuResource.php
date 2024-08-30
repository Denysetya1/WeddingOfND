<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZonawaktuResource\Pages;
use App\Filament\Resources\ZonawaktuResource\RelationManagers;
use App\Models\Zonawaktu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ZonawaktuResource extends Resource
{
    protected static ?string $model = Zonawaktu::class;
    protected static ?string $slug = 'zona-waktu';
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $activeNavigationIcon = 'heroicon-m-clock';
    protected static ?string $navigationLabel = 'Zona Waktu';
    protected static ?string $navigationGroup = 'Pengaturan Undangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ket')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ket')->label('Zona')
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
                Tables\Actions\EditAction::make()->color('warning'),
                Tables\Actions\DeleteAction::make()
                ->color('danger')
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
            'index' => Pages\ListZonawaktus::route('/'),
            'create' => Pages\CreateZonawaktu::route('/create'),
            'edit' => Pages\EditZonawaktu::route('/{record}/edit'),
        ];
    }
}
