<?php

namespace App\Livewire;

use App\Models\Pesan;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Ucapan extends Component
{
    use WithPagination;
    public $doa = [
        'user_id' => '',
        'name' => '',
        'ucapan' => ''
    ];
    protected $rules = [
        'doa.name' => 'required|min:3',
        'doa.ucapan' => 'required',
    ];
    protected $messages = [
        'doa.name.required' => 'Mohon Diisi',
        'doa.name.min' => 'Mohon Diisi Dengan Minimal 3 Karakter',
        'doa.ucapan.required' => 'Mohon Diisi',
    ];
    public $uid;
    public function mount($keys){
        $id = User::where('slug', $keys['uslug'])->first();
        $this->uid  = $id['id'];
    }
    public function render()
    {
        $pesan = Pesan::where('user_id', $this->uid)->orderBy('created_at', 'DESC')->get();
        // dd($pesan);
        return view('livewire.ucapan', [
            'pesans' => $pesan,
        ]);
    }
    public function submitFormDoa()
    {
        $this->validate();

        $this->doa['user_id'] = $this->uid;
        $pesan = Pesan::create($this->doa);

        $this->dispatch('swal',
            title: 'Berhasil Dikirim',
            timer: 2000,
            icon: 'success',
            text: 'Terima Kasih Atas Ucapan dan Doanya '.$this->doa['name'],
            showConfirmButton: false,
        );

        $this->reset('doa');

    }
}
