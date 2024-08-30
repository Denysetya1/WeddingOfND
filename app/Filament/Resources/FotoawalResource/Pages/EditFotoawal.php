<?php

namespace App\Filament\Resources\FotoawalResource\Pages;

use App\Filament\Resources\FotoawalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFotoawal extends EditRecord
{
    protected static string $resource = FotoawalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'Edit Foto Bagian Awal';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
