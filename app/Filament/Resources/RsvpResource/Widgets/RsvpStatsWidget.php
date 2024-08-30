<?php

namespace App\Filament\Resources\RsvpResource\Widgets;

use App\Models\Rsvp;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RsvpStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Konfirmasi Kehadiran', Rsvp::where('user_id', auth()->id())->count()),
            Stat::make('Jumlah Orang Yang Hadir', Rsvp::where('user_id', auth()->id())->sum('jumlah')),
        ];
    }
}
