<?php

namespace App\Filament\Resources\FotopengantinResource\Pages;

use App\Filament\Resources\FotopengantinResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFotopengantin extends CreateRecord
{
    protected static string $resource = FotopengantinResource::class;
    protected static bool $canCreateAnother = false;
    public function getTitle(): string
    {
        return 'Upload Foto Pengantin';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
