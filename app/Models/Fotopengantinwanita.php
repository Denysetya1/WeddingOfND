<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fotopengantinwanita extends Model
{
    use HasFactory;
    protected $fillable = ['foto_path', 'user_id', 'nama', 'nama_ayah', 'nama_ibu', 'anak_ke'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
