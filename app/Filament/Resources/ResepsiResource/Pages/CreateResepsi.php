<?php

namespace App\Filament\Resources\ResepsiResource\Pages;

use App\Filament\Resources\ResepsiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateResepsi extends CreateRecord
{
    protected static string $resource = ResepsiResource::class;
    protected static bool $canCreateAnother = false;

    public function getTitle(): string
    {
        return 'Buat Detail Resepsi';
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
