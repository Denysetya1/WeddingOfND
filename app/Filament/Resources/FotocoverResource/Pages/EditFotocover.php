<?php

namespace App\Filament\Resources\FotocoverResource\Pages;

use App\Filament\Resources\FotocoverResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFotocover extends EditRecord
{
    protected static string $resource = FotocoverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit Foto Bagian Cover';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
