<?php

namespace App\Filament\Resources\RsvpResource\Pages;

use App\Filament\Resources\RsvpResource;
use App\Filament\Resources\RsvpResource\Widgets\RsvpStatsWidget;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRsvps extends ManageRecords
{
    protected static string $resource = RsvpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->createAnother(false),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            RsvpStatsWidget::class
        ];
    }
}
