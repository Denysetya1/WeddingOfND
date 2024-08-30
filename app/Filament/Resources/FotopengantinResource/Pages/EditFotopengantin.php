<?php

namespace App\Filament\Resources\FotopengantinResource\Pages;

use App\Filament\Resources\FotopengantinResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFotopengantin extends EditRecord
{
    protected static string $resource = FotopengantinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'Edit Foto Pengantin';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
