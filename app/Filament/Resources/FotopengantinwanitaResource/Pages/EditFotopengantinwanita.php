<?php

namespace App\Filament\Resources\FotopengantinwanitaResource\Pages;

use App\Filament\Resources\FotopengantinwanitaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFotopengantinwanita extends EditRecord
{
    protected static string $resource = FotopengantinwanitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'Edit Foto Pengantin Wanita';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
