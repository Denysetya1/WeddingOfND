<?php

namespace App\Livewire;

use App\Models\Gallery as ModelsGallery;
use Livewire\Component;

class Gallery extends Component
{
    public $foto;
    public function mount($uid){
        $foto = ModelsGallery::where('user_id', $uid)->pluck('foto_path');
        $this->foto  = $foto;
    }
    public function render()
    {
        return view('livewire.gallery', [
            'foto' => $this->foto
        ]);
    }
}
