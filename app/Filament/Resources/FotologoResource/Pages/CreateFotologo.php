<?php

namespace App\Filament\Resources\FotologoResource\Pages;

use App\Filament\Resources\FotologoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFotologo extends CreateRecord
{
    protected static string $resource = FotologoResource::class;
    protected static bool $canCreateAnother = false;

    public function getTitle(): string
    {
        return 'Buat Foto Logo';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
