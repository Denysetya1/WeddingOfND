<?php

namespace App\Filament\Resources\FotopengantinpriaResource\Pages;

use App\Filament\Resources\FotopengantinpriaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFotopengantinpria extends EditRecord
{
    protected static string $resource = FotopengantinpriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'Edit Foto Pengantin Pria';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
