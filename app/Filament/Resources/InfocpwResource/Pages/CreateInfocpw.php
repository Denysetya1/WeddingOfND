<?php

namespace App\Filament\Resources\InfocpwResource\Pages;

use App\Filament\Resources\InfocpwResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInfocpw extends CreateRecord
{
    protected static string $resource = InfocpwResource::class;
    public function getTitle(): string
    {
        return 'Tambah Info Mempelai Wanita';
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
