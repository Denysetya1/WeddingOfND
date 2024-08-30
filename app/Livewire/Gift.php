<?php

namespace App\Livewire;

use Livewire\Component;

class Gift extends Component
{
    public $rek;
    public function mount($rekening){
        // dd($rekening);
        $this->rek  = $rekening;
    }
    public function render()
    {
        // dd($this->rek);
        return view('livewire.gift', [
            'reks' => $this->rek
        ]);
    }

    public function opengift()
    {
        $this->dispatch('swal:confirm');

    }

    public function salin($id)
    {
        $this->dispatch('salinrek', $id);
    }
}
