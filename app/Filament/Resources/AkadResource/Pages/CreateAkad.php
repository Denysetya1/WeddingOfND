<?php

namespace App\Filament\Resources\AkadResource\Pages;

use App\Filament\Resources\AkadResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAkad extends CreateRecord
{
    protected static string $resource = AkadResource::class;
    protected static bool $canCreateAnother = false;

    public function getTitle(): string
    {
        return 'Buat Detail Akad';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!auth()->user()->isAdmin()) {
            $data['user_id'] = auth()->id();
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
