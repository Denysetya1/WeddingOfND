<?php

namespace App\Filament\Resources\ZonawaktuResource\Pages;

use App\Filament\Resources\ZonawaktuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateZonawaktu extends CreateRecord
{
    protected static string $resource = ZonawaktuResource::class;
    public function getTitle(): string
    {
        return 'Tambah Zona Waktu';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
