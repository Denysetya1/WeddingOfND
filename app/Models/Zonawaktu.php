<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zonawaktu extends Model
{
    use HasFactory;
    protected $fillable = ['ket'];

    public function akad(): HasMany
    {
        return $this->hasMany(Akad::class);
    }
    public function resepsi(): HasMany
    {
        return $this->hasMany(Resepsi::class);
    }
}
