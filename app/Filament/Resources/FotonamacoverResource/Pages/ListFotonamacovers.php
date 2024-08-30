<?php

namespace App\Filament\Resources\FotonamacoverResource\Pages;

use App\Filament\Resources\FotonamacoverResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFotonamacovers extends ListRecords
{
    protected static string $resource = FotonamacoverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("Upload Foto"),
        ];
    }
    public function getTitle(): string
    {
        return 'Foto Nama';
    }
}
