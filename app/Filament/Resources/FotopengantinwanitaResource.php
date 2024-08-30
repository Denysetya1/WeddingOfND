<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FotopengantinwanitaResource\Pages;
use App\Filament\Resources\FotopengantinwanitaResource\RelationManagers;
use App\Models\Fotopengantinwanita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FotopengantinwanitaResource extends Resource
{
    protected static ?string $model = Fotopengantinwanita::class;
    protected static ?string $navigationLabel = 'Foto Penganti Wanita';
    protected static ?string $slug = 'foto-pengantin-wanita';
    protected static ?string $navigationIcon = 'heroicon-m-users';
    protected static ?string $activeNavigationIcon = 'heroicon-m-user-circle';
    protected static ?string $navigationGroup = 'Foto';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_ayah')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_ibu')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('anak_ke')
                    ->required(),
                Forms\Components\TextInput::make('foto_path')
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
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_ayah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_ibu')
                    ->searchable(),
                Tables\Columns\IconColumn::make('anak_ke')
                    ->boolean(),
                Tables\Columns\TextColumn::make('foto_path')
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
            'index' => Pages\ListFotopengantinwanitas::route('/'),
            'create' => Pages\CreateFotopengantinwanita::route('/create'),
            'edit' => Pages\EditFotopengantinwanita::route('/{record}/edit'),
        ];
    }
}
