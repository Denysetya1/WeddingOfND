<?php

namespace App\Observers;

use App\Models\Fotocover;
use Illuminate\Support\Facades\Storage;

class FotocoverObserver
{
    /**
     * Handle the Fotocover "created" event.
     */
    public function updated(Fotocover $fotocover): void
    {
        if ($fotocover->isDirty('foto_path')) {
            Storage::disk('public')->delete($fotocover->getOriginal('foto_path'));
        }
    }

    /**
     * Handle the Fotocover "deleted" event.
     */
    public function deleted(Fotocover $fotocover): void
    {
        if (! is_null($fotocover->foto_path)) {
            Storage::disk('public')->delete($fotocover->foto_path);
        }
    }
}
