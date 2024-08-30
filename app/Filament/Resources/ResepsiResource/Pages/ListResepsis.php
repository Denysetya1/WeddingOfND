<?php

namespace App\Filament\Resources\ResepsiResource\Pages;

use App\Filament\Resources\ResepsiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResepsis extends ListRecords
{
    protected static string $resource = ResepsiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("Tambah Detail"),
        ];
    }

    public function getTitle(): string
    {
        return 'Detail Resepsi';
    }
}
