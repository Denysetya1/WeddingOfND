<?php

namespace App\Filament\Resources\WeddinggiftResource\Pages;

use App\Filament\Resources\WeddinggiftResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeddinggift extends EditRecord
{
    protected static string $resource = WeddinggiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'Edit Rekening';
    }
}
