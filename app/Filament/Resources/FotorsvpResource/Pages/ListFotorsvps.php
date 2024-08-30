<?php

namespace App\Filament\Resources\FotorsvpResource\Pages;

use App\Filament\Resources\FotorsvpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFotorsvps extends ListRecords
{
    protected static string $resource = FotorsvpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("Upload Foto"),
        ];
    }
    public function getTitle(): string
    {
        return 'Foto RSVP';
    }
}
