<?php

namespace App\Filament\Resources\FotoawalResource\Pages;

use App\Filament\Resources\FotoawalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFotoawals extends ListRecords
{
    protected static string $resource = FotoawalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("Upload Foto"),
        ];
    }

    public function getTitle(): string
    {
        return 'Foto Bagian Awal';
    }
}
