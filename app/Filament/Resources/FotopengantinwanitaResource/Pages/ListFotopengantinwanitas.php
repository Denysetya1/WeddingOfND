<?php

namespace App\Filament\Resources\FotopengantinwanitaResource\Pages;

use App\Filament\Resources\FotopengantinwanitaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFotopengantinwanitas extends ListRecords
{
    protected static string $resource = FotopengantinwanitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("Upload Foto"),
        ];
    }
    public function getTitle(): string
    {
        return 'Foto Pengantin Wanita';
    }
}
