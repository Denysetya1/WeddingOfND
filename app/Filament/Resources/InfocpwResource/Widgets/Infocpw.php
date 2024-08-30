<?php

namespace App\Filament\Resources\InfocpwResource\Widgets;

use App\Models\Infocpw as ModelsInfocpw;
use Filament\Actions\Action;
use Filament\Widgets\Widget;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Infolists\Components\Actions\Action as ActionsAction;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;

class Infocpw extends Widget implements HasForms, HasInfolists, HasActions
{
    use InteractsWithActions;
    use InteractsWithInfolists;
    use InteractsWithForms;
    protected static ?string $model = ModelsInfocpw::class;
    protected static string $view = 'filament.resources.infocpw-resource.widgets.infocpw';
    public $data;

    public function infolist(Infolist $infolist): Infolist
    {
        // dd($this->data);
        return $infolist
            ->record($this->data)
            ->schema([
                Section::make('Pengantin Wanita')
                ->description('Informasi Pengantin Wanita')
                ->headerActions([
                    ActionsAction::make('edit')
                        ->color('warning')
                        ->url(fn (ModelsInfocpw $record): string => route('filament.admin.resources.infocpws.edit', $record)),
                ])
                ->schema([
                    TextEntry::make('nama')->default('kosong'),
                    TextEntry::make('anak_ke')->default('kosong'),
                    TextEntry::make('nama_ayah')->default('kosong'),
                    TextEntry::make('nama_ibu')->default('kosong'),
                ])->columns(2)
            ])
            ;
    }

    public function createAction(): Action
    {
        return
        Action::make('createCpw')
        ->label('Tambah Info Pengantin Wanita')
        ->url(fn (): string => route('filament.admin.resources.infocpws.create'));

    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }
}
