<?php

namespace App\Filament\Resources\InfocpwResource\Pages;

use App\Filament\Resources\InfocpwResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInfocpws extends ListRecords
{
    protected static string $resource = InfocpwResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
