<?php

namespace App\Filament\Resources\FotoawalResource\Pages;

use App\Filament\Resources\FotoawalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFotoawal extends CreateRecord
{
    protected static string $resource = FotoawalResource::class;
    protected static bool $canCreateAnother = false;

    public function getTitle(): string
    {
        return 'Tambah Foto Bagian Awal';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
