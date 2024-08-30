<?php

namespace App\Filament\Resources\FotopengantinwanitaResource\Pages;

use App\Filament\Resources\FotopengantinwanitaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFotopengantinwanita extends CreateRecord
{
    protected static string $resource = FotopengantinwanitaResource::class;
    public function getTitle(): string
    {
        return 'Upload Foto Pengantin Wanita';
    }
}
