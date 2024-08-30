<?php

namespace App\Filament\Resources\FotorsvpResource\Pages;

use App\Filament\Resources\FotorsvpResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFotorsvp extends EditRecord
{
    protected static string $resource = FotorsvpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'Edit Foto RSVP';
    }
}
