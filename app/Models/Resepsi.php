<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resepsi extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'zonawaktu_id',
        'tempat',
        'alamat',
        'url_map'
    ];

    protected $casts = [
        'tanggal' => 'datetime',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function zonawaktu(): BelongsTo
    {
        return $this->belongsTo(Zonawaktu::class);
    }
}
