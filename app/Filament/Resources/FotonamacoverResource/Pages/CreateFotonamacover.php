<?php

namespace App\Filament\Resources\FotonamacoverResource\Pages;

use App\Filament\Resources\FotonamacoverResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFotonamacover extends CreateRecord
{
    protected static string $resource = FotonamacoverResource::class;
    protected static bool $canCreateAnother = false;

    public function getTitle(): string
    {
        return 'Tambah Foto Nama';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
