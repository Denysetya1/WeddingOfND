<?php

namespace App\Filament\Resources\ResepsiResource\Pages;

use App\Filament\Resources\ResepsiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResepsi extends EditRecord
{
    protected static string $resource = ResepsiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit Detail Resepsi';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
