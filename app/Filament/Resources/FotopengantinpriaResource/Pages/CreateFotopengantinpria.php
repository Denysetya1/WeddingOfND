<?php

namespace App\Filament\Resources\FotopengantinpriaResource\Pages;

use App\Filament\Resources\FotopengantinpriaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFotopengantinpria extends CreateRecord
{
    protected static string $resource = FotopengantinpriaResource::class;

    public function getTitle(): string
    {
        return 'Upload Foto Pengantin Pria';
    }
}
