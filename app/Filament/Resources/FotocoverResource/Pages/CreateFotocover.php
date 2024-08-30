<?php

namespace App\Filament\Resources\FotocoverResource\Pages;

use App\Filament\Resources\FotocoverResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFotocover extends CreateRecord
{
    protected static string $resource = FotocoverResource::class;
    protected static bool $canCreateAnother = false;

    public function getTitle(): string
    {
        return 'Tambah Foto Bagian Cover';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
