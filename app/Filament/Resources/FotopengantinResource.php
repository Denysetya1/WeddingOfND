<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FotopengantinResource\Pages;
use App\Filament\Resources\FotopengantinResource\RelationManagers;
use App\Filament\Resources\InfocppResource\Widgets\Infocpp;
use App\Models\Fotopengantin;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FotopengantinResource extends Resource
{
    protected static ?string $model = Fotopengantin::class;

    protected static ?string $navigationLabel = 'Info Pengantin';
    protected static ?string $slug = 'foto-pengantin';
    protected static ?string $navigationIcon = 'heroicon-m-users';
    protected static ?string $activeNavigationIcon = 'heroicon-m-user-circle';
    protected static ?string $navigationGroup = 'Pengaturan Undangan';
    protected static ?int $navigationSort = 5;

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
                        Select::make('mempelai')
                        ->label('Foto Dari Mempelai')
                        ->helpertext('Masing-masing Mempelai Maksimal 3 Foto')
                        ->native(false)
                        ->required()
                        ->options([
                            'Calon Pengantin Wanita' => 'Wanita',
                            'Calon Pengantin Pria' => 'Pria',
                        ])
                        ->disableOptionWhen(function (string $value){
                            $cpp = Fotopengantin::where([['user_id', auth()->id()], ['mempelai', 'Calon Pengantin Pria']])->count();
                            $cpw = Fotopengantin::where([['user_id', auth()->id()], ['mempelai', 'Calon Pengantin Wanita']])->count();
                            if ($cpp == 3) {
                                return $value === 'Calon Pengantin Pria';
                            }
                            if ($cpw == 3) {
                                return $value === 'Calon Pengantin Wanita';
                            }
                        })
                    ]),
                Section::make('Foto Cover')
                    ->description('Foto yang Ditampilkan pada Cover Invitation Di Awal')
                    ->schema([
                        FileUpload::make('foto_path')
                        ->directory('foto-pengantin')
                        ->maxSize(2048)
                        ->image()
                        ->imagePreviewHeight('250')
                        ->loadingIndicatorPosition('left')
                        ->panelLayout('integrated')
                        ->removeUploadedFileButtonPosition('right')
                        ->uploadButtonPosition('left')
                        ->uploadProgressIndicatorPosition('left')
                        ,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultGroup('mempelai')
            ->headerActions([
                // function () {
                //     $cpp = Fotopengantin::where([['user_id', auth()->id()], ['mempelai', 'Calon Pengantin Pria']])->count();
                //     $cpw = Fotopengantin::where([['user_id', auth()->id()], ['mempelai', 'Calon Pengantin Wanita']])->count();
                //     if ($cpp < 3 OR $cpw < 3) {
                //         CreateAction::make()->label("Upload Foto");
                //     }
                // }
                CreateAction::make()->label("Upload Foto")->visible(function () {
                    $cpp = Fotopengantin::where([['user_id', auth()->id()], ['mempelai', 'Calon Pengantin Pria']])->count();
                    $cpw = Fotopengantin::where([['user_id', auth()->id()], ['mempelai', 'Calon Pengantin Wanita']])->count();
                    if ($cpp < 3 OR $cpw < 3) {
                        return true;
                    }
                    return false;
                })
            ])
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\ImageColumn::make('foto_path')
                        ->label('Foto Pengantin')
                        ->size(250)
                        ->checkFileExistence(false)
                        ->alignment(Alignment::Center),
                    Tables\Columns\TextColumn::make('mempelai')->label('Mempelai')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Calon Pengantin Pria' => 'sky',
                        'Calon Pengantin Wanita' => 'primary',
                    })
                    ->sortable()
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
                ['lg' => 2,
                'xl' => 3,]
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
            'index' => Pages\ListFotopengantins::route('/'),
            'create' => Pages\CreateFotopengantin::route('/create'),
            'edit' => Pages\EditFotopengantin::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            Infocpp::class,
        ];
    }
}
