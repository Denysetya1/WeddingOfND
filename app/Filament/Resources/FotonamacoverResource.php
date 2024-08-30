<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FotonamacoverResource\Pages;
use App\Filament\Resources\FotonamacoverResource\RelationManagers;
use App\Models\Fotonamacover;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FotonamacoverResource extends Resource
{
    protected static ?string $model = Fotonamacover::class;
    protected static ?string $navigationLabel = 'Foto Nama';
    protected static ?string $slug = 'foto-nama';
    protected static ?string $navigationIcon = 'heroicon-o-language';
    protected static ?string $activeNavigationIcon = 'heroicon-m-language';
    protected static ?string $navigationGroup = 'Foto';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Pelanggan')
                    ->description('Nama Pelanggan')
                    ->aside()
                    ->schema([
                        Forms\Components\Select::make('user_id')->relationship('user', 'name')->native(false)
                        ->label('Pelanggan')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->getSearchResultsUsing(fn (string $search): array => User::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                        ->getOptionLabelUsing(fn ($value): ?string => User::find($value)?->name)
                        ,
                    ]),
                Forms\Components\Section::make('Foto Nama Mempelai')
                    ->description('Foto Nama Panggilan Kedua Mempelai yang Ditampilkan Pada Bagian Awal Invitation. GUNAKAN FOTO TANPA BACKGROUND (TRANSPARAN) UNTUK HASIL LEBIH BAGUS')
                    ->schema([
                        Forms\Components\FileUpload::make('foto_path')
                        ->directory('foto-nama-awal')
                        ->maxSize(2048)
                        ->image()
                        ->imagePreviewHeight('250')
                        ->loadingIndicatorPosition('left')
                        ->panelLayout('integrated')
                        ->removeUploadedFileButtonPosition('left')
                        ->uploadButtonPosition('left')
                        ->uploadProgressIndicatorPosition('left')
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('9:16')
                        ->imageResizeTargetWidth('1080')
                        ->imageResizeTargetHeight('1920')
                        ,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\ImageColumn::make('foto_path')
                        ->label('Foto Cover')
                        ->size(250)
                        ->checkFileExistence(false)
                        ->alignment(Alignment::Center),
                    Tables\Columns\TextColumn::make('user.name')->label('Nama Pelanggan')
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
            'index' => Pages\ListFotonamacovers::route('/'),
            'create' => Pages\CreateFotonamacover::route('/create'),
            'edit' => Pages\EditFotonamacover::route('/{record}/edit'),
        ];
    }
}
