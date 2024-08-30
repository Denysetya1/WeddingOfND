<?php

namespace App\Filament\Resources\InfocpwResource\Pages;

use App\Filament\Resources\InfocpwResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInfocpw extends EditRecord
{
    protected static string $resource = InfocpwResource::class;

    public function getTitle(): string
    {
        return 'Edit Info Mempelai Pria';
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl;
    }
}
