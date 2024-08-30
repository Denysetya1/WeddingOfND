<?php

namespace App\Livewire;

use App\Models\Fotopengantin;
use App\Models\Infocpw;
use Livewire\Component;

class Cpw extends Component
{
    public $info, $foto;
    public function mount($uid){
        $info = Infocpw::where('user_id', $uid)->first();
        $foto = Fotopengantin::where([['user_id', $uid], ['mempelai', 'Calon Pengantin Wanita']])->pluck('foto_path');
        $this->info  = $info;
        $this->foto  = $foto;
    }
    public function render()
    {
        return view('livewire.cpw', [
            'info' => $this->info,
            'foto' => $this->foto
        ]);
    }
}
