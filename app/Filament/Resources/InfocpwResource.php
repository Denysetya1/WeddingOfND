<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfocpwResource\Pages;
use App\Filament\Resources\InfocpwResource\RelationManagers;
use App\Models\Infocpw;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InfocpwResource extends Resource
{
    protected static ?string $model = Infocpw::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Mempelai Wanita')
                ->description('Isikan Nama dengan Lengkap')
                ->schema([
                    TextInput::make('nama')->label('Nama Mempelai Wanita')->columnspan(2),
                    TextInput::make('anak_ke')->label('Putri Ke-'),
                ])->columns(3),
                Section::make('Informasi Orang Tua')
                ->description('Tambahkan (Alm) di belakang nama orang tua jika sudah wafat. Contoh: Fulan (Alm)')
                ->schema([
                    TextInput::make('nama_ayah')->label('Nama Ayah'),
                    TextInput::make('nama_ibu')->label('Nama Ibu'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListInfocpws::route('/'),
            'create' => Pages\CreateInfocpw::route('/create'),
            'edit' => Pages\EditInfocpw::route('/{record}/edit'),
        ];
    }
}
