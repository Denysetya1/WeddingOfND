<?php

namespace App\Filament\Resources\WeddinggiftResource\Pages;

use App\Filament\Resources\WeddinggiftResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeddinggifts extends ListRecords
{
    protected static string $resource = WeddinggiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah No. Rekening'),
        ];
    }
    public function getTitle(): string
    {
        return 'Wedding Gift';
    }
}
