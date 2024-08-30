<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FotorsvpResource\Pages;
use App\Filament\Resources\FotorsvpResource\RelationManagers;
use App\Models\Fotorsvp;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FotorsvpResource extends Resource
{
    protected static ?string $model = Fotorsvp::class;
    protected static ?string $navigationLabel = 'Foto RSVP';
    protected static ?string $slug = 'foto-rsvp';
    protected static ?string $navigationIcon = 'heroicon-o-bookmark';
    protected static ?string $activeNavigationIcon = 'heroicon-m-bookmark';
    protected static ?string $navigationGroup = 'Foto';
    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
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
            'index' => Pages\ListFotorsvps::route('/'),
            'create' => Pages\CreateFotorsvp::route('/create'),
            'edit' => Pages\EditFotorsvp::route('/{record}/edit'),
        ];
    }
}
