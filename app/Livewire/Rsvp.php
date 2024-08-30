<?php

namespace App\Livewire;

use App\Models\Rsvp as ModelsRsvp;
use App\Models\Undangan;
use App\Models\User;
use Livewire\Component;

class Rsvp extends Component
{
    public $rsvp = [
        'user_id' => '',
        'kode' => '',
        'name' => '',
        'jumlah' => ''
    ];
    protected $rules = [
        'rsvp.name' => 'required|min:3',
        'rsvp.jumlah' => 'required',
    ];
    protected $messages = [
        'rsvp.name.required' => 'Mohon Diisi',
        'rsvp.name.min' => 'Mohon Diisi Dengan Minimal 3 Karakter',
        'rsvp.jumlah.required' => 'Mohon Diisi',
    ];
    public $uid, $kode;
    public function mount($keys){
        $id = User::where('slug', $keys['uslug'])->first();
        $this->uid  = $id['id'];
        $this->kode  = $keys['kode'];
        $name = Undangan::where([['user_id', $this->uid], ['kode', $this->kode]])->first();
        $this->rsvp['name'] = $name['name'];
    }
    public function render()
    {
        $data = ModelsRsvp::where([['user_id', $this->uid], ['kode', $this->kode]])->first();
        if ($data) {
            $this->rsvp['jumlah'] = $data['jumlah'];
        }
        return view('livewire.rsvp', [
            'data' => $data,
        ]);
    }

    public function submitForm()
    {
        $this->validate();
        // dd($this->rsvp['jumlah']);
        $product = ModelsRsvp::updateOrCreate([
            'kode'=> $this->kode
        ],[
            'user_id' => $this->uid,
            'name' => $this->rsvp['name'],
            'jumlah' => $this->rsvp['jumlah']
        ]);

        $this->dispatch('swal',
            title: 'Berhasil Dikirim',
            timer: 3000,
            icon: 'success',
            text: 'Terima Kasih Atas Konfirmasinya '.$this->rsvp['name'],
            showConfirmButton: false,
        );

        // $this->reset('rsvp');
        // $this->rsvp['name'] = $product['name'];
        // $this->dispatch('setJumlahSelect', []);

    }

    public function cancel($id)
    {
        $data = ModelsRsvp::findOrFail($id);
        $data->delete();
        $this->rsvp['jumlah'] = null;
        $this->dispatch('swal',
            title: 'Berhasil Dibatalkan',
            timer: 3000,
            icon: 'success',
            text: 'Terima Kasih Atas Konfirmasinya '.$data['name'],
            showConfirmButton: false,
        );
    }
}
