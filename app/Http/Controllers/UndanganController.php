<?php

namespace App\Http\Controllers;

use App\Models\Undangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UndanganController extends Controller
{
    public function show(User $user, Undangan $undangan){
        // dd($user, $undangan);
        // $data = Undangan::where('user_id', $user->id)->first();
        return view('home', [
            'data' => $undangan,
            'uslug' => $user['slug'],
        ]);
    }
}
