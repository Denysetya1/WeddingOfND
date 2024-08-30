<?php

namespace App\Filament\Resources\WeddinggiftResource\Pages;

use App\Filament\Resources\WeddinggiftResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWeddinggift extends CreateRecord
{
    protected static string $resource = WeddinggiftResource::class;
    public function getTitle(): string
    {
        return 'Tambah Rekening';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
