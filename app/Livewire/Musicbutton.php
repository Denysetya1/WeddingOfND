<?php

namespace App\Livewire;

use Livewire\Component;

class Musicbutton extends Component
{
    public $playpause = true;
    public function render()
    {
        return view('livewire.musicbutton');
    }

    public function pp(){
        // dd($this->playpause);
        if(!$this->playpause){
            $this->playpause = true;
            // $this->dispatch('play');
        } else {
            $this->playpause = false;
            // $this->dispatch('pause');
        }
    }
}
