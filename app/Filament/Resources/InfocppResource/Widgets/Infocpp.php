<?php

namespace App\Filament\Resources\InfocppResource\Widgets;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use App\Models\Infocpp as ModelsInfocpp;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Section as ComponentsSection;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Actions\Action as ActionsAction;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\Widget;
use Livewire\Component;

class Infocpp extends Widget implements HasForms, HasInfolists, HasActions
{
    use InteractsWithActions;
    use InteractsWithInfolists;
    use InteractsWithForms;
    protected static ?string $model = ModelsInfocpp::class;
    protected static string $view = 'filament.resources.infocpp-resource.widgets.infocpp';
    public $data;

    public function infolist(Infolist $infolist): Infolist
    {
        // dd($this->data);
        return $infolist
            ->record($this->data)
            ->schema([
                Section::make('Pengantin Pria')
                ->description('Informasi Pengantin Pria')
                ->headerActions([
                    ActionsAction::make('edit')
                        ->color('warning')
                        ->url(fn (ModelsInfocpp $record): string => route('filament.admin.resources.infocpps.edit', $record)),
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
        Action::make('createCpp')
        ->label('Tambah Info Pengantin Pria')
        ->url(fn (): string => route('filament.admin.resources.infocpps.create'));

    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }
}
