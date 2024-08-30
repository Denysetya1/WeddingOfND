<?php

namespace App\Filament\Resources\InfocppResource\Pages;

use App\Filament\Resources\InfocppResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInfocpp extends EditRecord
{
    protected static string $resource = InfocppResource::class;

    public function getTitle(): string
    {
        return 'Edit Info Mempelai Pria';
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl;
    }
}
