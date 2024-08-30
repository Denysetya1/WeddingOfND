<?php

namespace App\Filament\Resources;

use App\Filament\Imports\UndanganImporter;
use App\Filament\Resources\UndanganResource\Pages;
use App\Filament\Resources\UndanganResource\RelationManagers;
use App\Imports\UndangansImport;
use App\Models\Undangan;
use App\Models\User;
use App\Traits\WablasTrait;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;

class UndanganResource extends Resource
{
    protected static ?string $model = Undangan::class;
    protected static ?string $modelLabel = 'Tamu Undangan Digital';
    protected static ?string $navigationLabel = 'List Tamu Undangan';
    protected static ?string $slug = 'list-tamu-undangan';
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $activeNavigationIcon = 'heroicon-o-envelope-open';
    protected static ?int $navigationSort = 1;

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
                        ->getOptionLabelUsing(fn ($value): ?string => User::find($value)?->name),
                    ]),
                TextInput::make('name')->label('Nama')->live(onBlur: true)->required()->minLength(3)
                ->afterStateUpdated(function (String $operation, $state, Set $set) {
                    if($operation === 'edit' ){
                        return;
                    }
                    $slug = Str::slug($state);
                    $cek = Undangan::where('slug', $slug)->first();
                    if($cek) {
                        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersNumber = strlen($characters);

                        $code = '';

                        while (strlen($code) < 3) {
                            $position = rand(0, $charactersNumber - 1);
                            $character = $characters[$position];
                            $code = $code.$character;
                        }
                        $slug = $slug.'-'.$code;
                    }
                    $set('slug', $slug);
                    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersNumber = strlen($characters);

                    $code = '';

                    while (strlen($code) < 6) {
                        $position = rand(0, $charactersNumber - 1);
                        $character = $characters[$position];
                        $code = $code.$character;
                    }

                    $code = $code.'-'.strtok($state, " ");
                    $set('kode', $code);
                }),
                TextInput::make('phone')->label('No. WA')->tel()->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')->required(),
                TextInput::make('slug')->required()->minLength(3)->unique(ignoreRecord: true)->readOnly()->helperText('Terisi Otomatis'),
                TextInput::make('kode')->label('Kode Unik')->required()->unique(ignoreRecord: true)->readOnly()->helperText('Terisi Otomatis'),
                FileUpload::make('photo_path')
                ->directory('foto-ruang')
                ->maxSize(2048)
                ->image()
                ->imagePreviewHeight('250')
                ->loadingIndicatorPosition('left')
                ->panelLayout('integrated')
                ->removeUploadedFileButtonPosition('right')
                ->uploadButtonPosition('left')
                ->uploadProgressIndicatorPosition('left')
                // MarkdownEditor::make('pembuka')->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->headerActions([
            //     ImportAction::make()
            //         ->importer(UndanganImporter::class),
            //     CreateAction::make('Import Data Tamu')->label('Import Excel')->color('new')
            //     // ->modalContent(view('filament.custom.upload-file-field'))
            //     // ->requiresConfirmation()->icon('heroicon-m-check')
            //     ->form([
            //         FileUpload::make('import')->label('File Excel')->required()
            //         ->acceptedFileTypes(['application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','text/csv']),
            //     ])
            //     ->action(function ($data){
            //         // dd( asset('storage/'.$data['import']));
            //         Excel::import(new UndangansImport, storage_path($data['import']));
            //     })
            //     ->successNotification(
            //         Notification::make()
            //              ->success()
            //              ->title('Berhasil Mengimport Data')
            //              ->body('Data pada Excel Berhasil Di Tambahkan.'),
            //      )
            // ])
            ->columns([
                // TextColumn::make('no')->state(
                //     static function (HasTable $livewire, stdClass $rowLoop): string {
                //         return (string) (
                //             $rowLoop->iteration +
                //             ($livewire->getTableRecordsPerPage() * (
                //                 $livewire->getTablePage() - 1
                //             ))
                //         );
                //     }
                // ),
                TextColumn::make('name')->label('Nama')->wrap()->sortable()->searchable(),
                TextColumn::make('slug')->url(fn (Undangan $record): string => route('undangan.show', [
                    'user' => $record->user['slug'],
                    'undangan' => $record['slug']
                ]))
                ->openUrlInNewTab()->color('link'),
                TextColumn::make('kode')->label('Kode Unik')->badge()->color('sky')->searchable(),
                TextColumn::make('phone')->label('No. WA')->searchable()->sortable(),
                TextColumn::make('pembuka')->markdown()->limit(100)->wrap()->sortable()
                ->tooltip(function (TextColumn $column): ?string {
                    $state = $column->getState();

                    if (strlen($state) <= $column->getCharacterLimit()) {
                        return null;
                    }

                    // Only render the tooltip if the column content exceeds the length limit.
                    return $state;
                })->copyable()
                ->copyMessage('Pesan Berhasil Di Copy')
                ->copyMessageDuration(1500),
                IconColumn::make('terkirim')->label('Pesan Terkirim')->alignment(Alignment::Center)
                ->tooltip(function (IconColumn $column): ?string {
                    $state = $column->getState();

                    if ($state == 0) {
                        return 'Belum Dikirim';
                    }

                    // Only render the tooltip if the column content exceeds the length limit.
                    return 'Pesan Terkirim';
                })
                ->boolean()
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                Filter::make('terkirim')->label('Terkirim')->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('terkirim', false))
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()
                    ->color('warning'),
                    Tables\Actions\DeleteAction::make()
                    ->color('danger')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Berhasil Terhapus')
                            ->body('Tamu Undangan Behasil Dihapus.'),
                    ),
                    Action::make('send')->label('Kirim Pesan')->color('info')->icon('heroicon-m-paper-airplane')
                        ->requiresConfirmation()
                        ->modalHeading('Kirim Pesan')
                        ->modalDescription('Anda Yakin Untuk Mengirim Pesan Ke Tamu Undangan?')
                        ->modalSubmitActionLabel('Yes, Saya Yakin')
                        ->action(function (Undangan $records){
                            if ($records['pembuka'] == null){
                                return Notification::make()
                                ->danger()
                                ->title('Gagal Mengirim Pesan')
                                ->body('Lakukan Generate Pesan Terlebih Dahulu.')
                                ->send();
                            } else {
                                $kumpulan_data = [];
                                $data['phone'] = $records->phone;
                                $data['message'] = $records->pembuka;
                                $data['secret'] = false;
                                $data['retry'] = false;
                                $data['isGroup'] = false;
                                array_push($kumpulan_data, $data);
                                $records->update(['terkirim' => true]);
                                WablasTrait::sendText($kumpulan_data);
                                return Notification::make()
                                ->success()
                                ->title('Berhasil Mengirim Pesan')
                                ->body('Pesan Berhasil Dikirimkan Kepada Tamu Undangan.')
                                ->send();
                            }})
                ])->color('warning')->tooltip('Actions'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                BulkAction::make('send')
                ->icon('heroicon-m-paper-airplane')
                ->requiresConfirmation()
                ->modalHeading('Kirim Pesan')
                ->modalDescription('Anda Yakin Untuk Mengirim Pesan Ke Tamu Undangan?')
                ->modalSubmitActionLabel('Yes, Saya Yakin')
                ->action(function (Collection $records){
                    $total = $records->count();
                    $i = $total;
                    foreach ($records as $key => $value) {
                        if ($value->pembuka == null) {
                            $i--;
                        }
                    }
                    if ($i < $total){
                        return Notification::make()
                        ->danger()
                        ->title('Gagal Mengirim Pesan')
                        ->body('Lakukan Generate Pesan Terlebih Dahulu.')
                        ->send();
                    } else {
                        $records->each(function ($record){
                            if($record->terkirim == false) {
                                if(!is_null($record->phone)){
                                    $kumpulan_data = [];
                                    $data['phone'] = $record->phone;
                                    $data['message'] = $record->pembuka;
                                    $data['secret'] = false;
                                    $data['retry'] = false;
                                    $data['isGroup'] = false;
                                    array_push($kumpulan_data, $data);
                                    $record->update(['terkirim' => true]);
                                    // dd('false');
                                    WablasTrait::sendText($kumpulan_data);
                                }
                            }
                        });
                        return Notification::make()
                        ->success()
                        ->title('Berhasil Mengirim Pesan')
                        ->body('Pesan Berhasil Dikirimkan Kepada Tamu Undangan.')
                        ->send();
                    }
                })->deselectRecordsAfterCompletion(),
            ])->recordUrl(null)
            // ->checkIfRecordIsSelectableUsing(
            //     fn (Model $record): bool => $record->pembuka !== null,
            // )
            ;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUndangans::route('/'),
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
