<?php

namespace App\Filament\Resources\FotocoverResource\Pages;

use App\Filament\Resources\FotocoverResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFotocovers extends ListRecords
{
    protected static string $resource = FotocoverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("Upload Foto"),
        ];
    }

    public function getTitle(): string
    {
        return 'Foto Bagian Cover';
    }
}
