<?php

namespace App\Filament\Resources\InfocppResource\Pages;

use App\Filament\Resources\InfocppResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInfocpp extends CreateRecord
{
    protected static string $resource = InfocppResource::class;
    protected static bool $canCreateAnother = false;

    public function getTitle(): string
    {
        return 'Tambah Info Mempelai Pria';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl;
    }
}
