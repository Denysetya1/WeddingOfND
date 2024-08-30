<?php

namespace App\Filament\Resources\FotopengantinpriaResource\Pages;

use App\Filament\Resources\FotopengantinpriaResource;
use App\Filament\Resources\InfocppResource\Widgets\Infocpp;
use App\Models\Infocpp as ModelsInfocpp;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFotopengantinprias extends ListRecords
{
    protected static string $resource = FotopengantinpriaResource::class;
    protected $listeners = ['refreshPage' => '$refresh'];

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("Upload Foto"),
        ];
    }
    public function getTitle(): string
    {
        return 'Foto Pengantin Pria';
    }

    protected function getHeaderWidgets(): array
    {
        $data = ModelsInfocpp::where('user_id', auth()->id())->first();
        return [
            Infocpp::make([
                'data' => $data,
            ]),
        ];
    }
    public function updated($name)
    {
        $this->emit('refreshPage');
    }
}
