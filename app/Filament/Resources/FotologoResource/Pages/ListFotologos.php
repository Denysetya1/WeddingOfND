<?php

namespace App\Filament\Resources\FotologoResource\Pages;

use App\Filament\Resources\FotologoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFotologos extends ListRecords
{
    protected static string $resource = FotologoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("Upload Foto"),
        ];
    }
    public function getTitle(): string
    {
        return 'Foto Logo';
    }
}
