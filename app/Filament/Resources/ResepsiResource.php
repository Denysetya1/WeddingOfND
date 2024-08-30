<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResepsiResource\Pages;
use App\Filament\Resources\ResepsiResource\Pages\CreateResepsi;
use App\Filament\Resources\ResepsiResource\RelationManagers;
use App\Models\Resepsi;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Guava\FilamentClusters\Forms\Cluster;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResepsiResource extends Resource
{
    protected static ?string $model = Resepsi::class;
    protected static ?string $navigationLabel = 'Resepsi';
    protected static ?string $slug = 'detail-resepsi';
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $activeNavigationIcon = 'heroicon-m-sparkles';
    protected static ?string $navigationGroup = 'Detail Acara';

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
                Section::make('Waktu dan Tanggal')
                    ->description('Pastikan Tanggal, Waktu Mulai dan Waktu Selesai Sudah Benar')
                    ->aside()
                    ->schema([
                        Forms\Components\DatePicker::make('tanggal')
                        ->label('Tanggal')->native(false)->after('today')
                        ->required()->columnSpan(2),
                        Cluster::make([
                            Forms\Components\TimePicker::make('waktu_mulai')
                            ->format('H:i')->label('Waktu Mulai')
                            ->datalist([
                                '08:00','08:30','09:00','09:30','10:00','14:00','14:30','15:00'
                            ])->required(),
                            Forms\Components\TimePicker::make('waktu_selesai')
                            ->format('H:i')->label('Waktu Selesai')
                            ->datalist([
                                '08:00','08:30','09:00','09:30','10:00','14:00','14:30','15:00'
                            ])->helperText('Kosongkan Jika Tidak Pasti'),
                            Forms\Components\Select::make('zonawaktu_id')
                            ->label('Zona Waktu')->native(false)
                            ->relationship(name: 'zonawaktu', titleAttribute: 'ket')
                            ->selectablePlaceholder(false)
                            ->required(),
                        ])->label('Waktu')->hint('Masukan Waktu Mulai dan Selesai Acara')
                        ->helperText('Kosongkan Waktu Selesai Jika Tidak Pasti')->columnSpan(3),
                    ])->columns(5),
                Section::make('Tempat')->description('Pastikan Tempat Acara Sudah Benar')
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('tempat')
                            ->helperText('Contoh: Rumah Kediaman Mempelai Wanita / Masjid Agung')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('alamat')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('url_map')
                            ->required()
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    Grid::make(12)
                    ->schema([
                        Tables\Columns\TextColumn::make('tanggal')
                            ->date('l, d F Y')
                            ->sortable()->columnSpan(2),
                        Stack::make([
                            Tables\Columns\TextColumn::make('waktu_mulai')->date('H:i')->grow(false)->sortable(),
                            Tables\Columns\TextColumn::make('waktu_selesai')->date('H:i')->default('Selesai')->grow(false),
                        ])->alignment(Alignment::End)->grow(false),
                        Tables\Columns\TextColumn::make('zonawaktu.ket'),
                        Stack::make([
                            Tables\Columns\TextColumn::make('tempat')->alignment(Alignment::End)
                                ->searchable(),
                            Tables\Columns\TextColumn::make('alamat')->alignment(Alignment::End)
                                ->searchable(),
                            Tables\Columns\TextColumn::make('url_map')->alignment(Alignment::End)
                            ->url(fn (Resepsi $record): string => $record['url_map'])
                            ->openUrlInNewTab()->color('sky'),
                        ])->space(2)->columnSpan(8),
                    ]),
                ])
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()->color('warning'),
                    Tables\Actions\DeleteAction::make(),
                ])->color('warning')->tooltip('Actions'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum Ada Detail Resepsi')
            ->emptyStateDescription('Masing-masing Akun Hanya Bisa Input Satu Acara Resepsi.')
            ->emptyStateActions([
                Action::make('create')
                    ->label('Tambah Detail Resepsi')
                    ->url(fn (): string => CreateResepsi::getUrl())
                    ->icon('heroicon-m-plus')
                    ->button()
                    ->visible(! Resepsi::where('user_id', auth()->id())->first()),
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
            'index' => Pages\ListResepsis::route('/'),
            'create' => Pages\CreateResepsi::route('/create'),
            'edit' => Pages\EditResepsi::route('/{record}/edit'),
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
