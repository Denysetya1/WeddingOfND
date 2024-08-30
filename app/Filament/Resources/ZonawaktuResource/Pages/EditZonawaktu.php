<?php

namespace App\Filament\Resources\ZonawaktuResource\Pages;

use App\Filament\Resources\ZonawaktuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZonawaktu extends EditRecord
{
    protected static string $resource = ZonawaktuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'Edit Zona Waktu';
    }
}
