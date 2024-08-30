<?php

namespace App\Filament\Resources\ZonawaktuResource\Pages;

use App\Filament\Resources\ZonawaktuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListZonawaktus extends ListRecords
{
    protected static string $resource = ZonawaktuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Zona Waktu'),
        ];
    }
    public function getTitle(): string
    {
        return 'Zona Waktu';
    }
}
