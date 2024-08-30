<?php

namespace App\Livewire;

use App\Models\Fotopengantin;
use App\Models\Infocpp;
use Livewire\Component;

class Cpp extends Component
{
    public $info, $foto;
    public function mount($uid){
        $info = Infocpp::where('user_id', $uid)->first();
        $foto = Fotopengantin::where([['user_id', $uid], ['mempelai', 'Calon Pengantin Pria']])->pluck('foto_path');
        $this->info  = $info;
        $this->foto  = $foto;
    }
    public function render()
    {
        return view('livewire.cpp', [
            'info' => $this->info,
            'foto' => $this->foto
        ]);
    }
}
