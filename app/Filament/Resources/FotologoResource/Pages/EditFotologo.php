<?php

namespace App\Filament\Resources\FotologoResource\Pages;

use App\Filament\Resources\FotologoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFotologo extends EditRecord
{
    protected static string $resource = FotologoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'Edit Foto Logo';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
