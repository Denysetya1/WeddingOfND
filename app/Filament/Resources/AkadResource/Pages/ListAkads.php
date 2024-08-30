<?php

namespace App\Filament\Resources\AkadResource\Pages;

use App\Filament\Resources\AkadResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAkads extends ListRecords
{
    protected static string $resource = AkadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("Tambah Detail"),
        ];
    }

    public function getTitle(): string
    {
        return 'Detail Akad / Pemberkatan';
    }
}
