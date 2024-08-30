<?php

namespace App\Filament\Resources\FotopengantinResource\Pages;

use App\Filament\Resources\FotopengantinResource;
use App\Filament\Resources\InfocppResource\Widgets\Infocpp;
use App\Filament\Resources\InfocpwResource\Widgets\Infocpw;
use App\Models\Fotopengantin;
use App\Models\Infocpp as ModelsInfocpp;
use App\Models\Infocpw as ModelsInfocpw;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFotopengantins extends ListRecords
{
    protected static string $resource = FotopengantinResource::class;

    // protected function getHeaderActions(): array
    // {
    //     $cpp = Fotopengantin::where([['user_id', auth()->id()], ['mempelai', 'Calon Pengantin Pria']])->count();
    //     $cpw = Fotopengantin::where([['user_id', auth()->id()], ['mempelai', 'Calon Pengantin Wanita']])->count();
    //     if ($cpp < 3 OR $cpw < 3) {
    //         return [
    //             Actions\CreateAction::make()->label("Upload Foto"),
    //         ];
    //     }
    //     return [Actions\Action::make('Upload Foto')
    //     ->disabled()];
    // }

    public function getTitle(): string
    {
        return 'Info dan Foto Pengantin';
    }
    protected function getHeaderWidgets(): array
    {
        $datap = ModelsInfocpp::where('user_id', auth()->id())->first();
        $dataw = ModelsInfocpw::where('user_id', auth()->id())->first();
        return [
            Infocpp::make([
                'data' => $datap,
            ]),
            Infocpw::make([
                'data' => $dataw,
            ]),
        ];
    }
}
