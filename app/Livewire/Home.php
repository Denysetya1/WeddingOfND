<?php

namespace App\Livewire;

use App\Models\Akad;
use App\Models\Fotoawal;
use App\Models\Fotocover;
use App\Models\Fotologo;
use App\Models\Fotonamacover;
use App\Models\Resepsi;
use App\Models\User;
use App\Models\Weddinggift;
use Livewire\Component;

class Home extends Component
{
    public $closeModal = true;
    public $datas, $keys;
    public $tamu;
    // public $uid;
    public $pernikahan;
    public $foto;

    public function mount($data, $uslug){
        $slg = User::where('slug', $uslug)->first();
        $this->datas = $slg;
        // $this->uid  = $slg['id'];
        $this->pernikahan  = $slg['pernikahan'];
        $this->tamu = $data['name'];
        $this->keys['kode'] = $data['kode'];
        $this->keys['uslug'] = $uslug;
    }
    public function render()
    {
        // $akad = Akad::where('user_id', $this->uid)->first();
        // $resepsi = Resepsi::where('user_id', $this->uid)->first();
        // $rekening = Weddinggift::where('user_id', $this->uid)->get();
        if($cover = $this->datas->fotocover['foto_path']){
            $this->foto['cover'] = $cover;
        }else {
            $this->foto['cover'] = null;
        }
        if($awal = $this->datas->fotoawal['foto_path']){
            $this->foto['awal'] = $awal;
        }else {
            $this->foto['awal'] = null;
        }
        if($logo = $this->datas->fotologo['foto_path']){
            $this->foto['logo'] = $logo;
        }else {
            $this->foto['logo'] = null;
        }
        if($nama = $this->datas->fotonamacover['foto_path']){
            $this->foto['nama'] = $nama;
        }else {
            $this->foto['nama'] = null;
        }
        // dd($akad);
        return view('livewire.home', [
            'uid' => $this->datas['id'],
            'foto' => $this->foto,
            'keys' => $this->keys,
            'akad' => $this->datas->akad,
            'resepsi' => $this->datas->resepsi,
            'rekening' => $this->datas->weddinggift,
        ]);
    }

    public function close() {
        $this->closeModal = false;
    }
}
