<?php

namespace App\Filament\Resources\AkadResource\Pages;

use App\Filament\Resources\AkadResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAkad extends EditRecord
{
    protected static string $resource = AkadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit Detail Akad';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
