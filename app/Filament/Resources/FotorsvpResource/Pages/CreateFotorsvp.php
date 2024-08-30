<?php

namespace App\Filament\Resources\FotorsvpResource\Pages;

use App\Filament\Resources\FotorsvpResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFotorsvp extends CreateRecord
{
    protected static string $resource = FotorsvpResource::class;
    public function getTitle(): string
    {
        return 'Upload Foto RSVP';
    }
}
