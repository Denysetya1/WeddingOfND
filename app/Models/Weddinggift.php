<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Weddinggift extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bank_name',
        'no_rek',
        'nama_rek'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
