<?php

namespace App\Filament\Resources\FotonamacoverResource\Pages;

use App\Filament\Resources\FotonamacoverResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFotonamacover extends EditRecord
{
    protected static string $resource = FotonamacoverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit Foto Nama';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
