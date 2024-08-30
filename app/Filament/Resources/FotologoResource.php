<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FotologoResource\Pages;
use App\Filament\Resources\FotologoResource\RelationManagers;
use App\Models\Fotologo;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FotologoResource extends Resource
{
    protected static ?string $model = Fotologo::class;
    protected static ?string $navigationLabel = 'Foto Logo';
    protected static ?string $slug = 'foto-logo';
    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $activeNavigationIcon = 'heroicon-s-swatch';
    protected static ?string $navigationGroup = 'Foto';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Pelanggan')
                    ->description('Nama Pelanggan')
                    ->aside()
                    ->schema([
                        Select::make('user_id')->relationship('user', 'name')->native(false)
                        ->label('Pelanggan')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->getSearchResultsUsing(fn (string $search): array => User::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                        ->getOptionLabelUsing(fn ($value): ?string => User::find($value)?->name)
                        ,
                    ]),
                Section::make('Foto Logo')
                    ->description('Foto Logo Kedua Mempelai yang Ditampilkan Pada Bagian Awal Invitation. GUNAKAN FOTO TANPA BACKGROUND (TRANSPARAN) UNTUK HASIL LEBIH BAGUS')
                    ->schema([
                        FileUpload::make('foto_path')
                        ->directory('foto-logo')
                        ->maxSize(1024)
                        ->image()
                        ->imagePreviewHeight('250')
                        ->loadingIndicatorPosition('left')
                        ->panelLayout('integrated')
                        ->removeUploadedFileButtonPosition('left')
                        ->uploadButtonPosition('left')
                        ->uploadProgressIndicatorPosition('left')
                        ,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    ImageColumn::make('foto_path')
                        ->label('Foto Cover')
                        ->size(250)
                        ->checkFileExistence(false)
                        ->alignment(Alignment::Center),
                    TextColumn::make('user.name')->label('Nama Pelanggan')
                    ->sortable()
                    ->searchable()
                    ->alignment(Alignment::Center)
                    ->visible(function (){
                        if (auth()->user()->isAdmin()) {
                            return true;
                        } else {
                            return false;
                        }
                    })
                ])->space(2)
            ])->contentGrid(
                function (){
                    if (auth()->user()->isAdmin()) {
                        return['lg' => 2,
                        'xl' => 3,];
                    } else {
                        return 1;
                    }
                }
            )
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
            'index' => Pages\ListFotologos::route('/'),
            'create' => Pages\CreateFotologo::route('/create'),
            'edit' => Pages\EditFotologo::route('/{record}/edit'),
        ];
    }
}
