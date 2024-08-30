<?php

namespace App\Filament\Resources\InfocppResource\Pages;

use App\Filament\Resources\InfocppResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInfocpps extends ListRecords
{
    protected static string $resource = InfocppResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
