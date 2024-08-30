<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesanResource\Pages;
use App\Filament\Resources\PesanResource\RelationManagers;
use App\Models\Pesan;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PesanResource extends Resource
{
    protected static ?string $model = Pesan::class;
    protected static ?string $modelLabel = 'Ucapan & Doa Restu';
    protected static ?string $navigationLabel = 'Ucapan & Doa Restu';
    protected static ?string $slug = 'list-doa-ucapan';
    protected static ?string $navigationIcon = 'heroicon-s-chat-bubble-left';
    protected static ?string $activeNavigationIcon = 'heroicon-s-chat-bubble-left-right';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('ucapan')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    Grid::make(2)
                    ->schema([
                        TextColumn::make('name')->sortable()->searchable(),
                        TextColumn::make('created_at')
                            ->since()
                            ->sortable()
                            ->alignment(Alignment::End)
                            ->size(TextColumn\TextColumnSize::ExtraSmall),
                        TextColumn::make('ucapan')
                            ->wrap()
                            ->weight(FontWeight::Bold)
                            ->size(TextColumn\TextColumnSize::Large)
                            ->fontFamily(FontFamily::Mono)
                            ->columnspan(2),
                    ]),
                ]),
            ])->contentGrid([
                'lg' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->color('warning'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->recordUrl(null)->deferLoading();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePesans::route('/'),
        ];
    }
}
