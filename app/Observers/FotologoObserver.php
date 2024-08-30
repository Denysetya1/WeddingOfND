<?php

namespace App\Observers;

use App\Models\Fotologo;
use Illuminate\Support\Facades\Storage;

class FotologoObserver
{
    /**
     * Handle the Fotologo "created" event.
     */
    public function updated(Fotologo $fotologo): void
    {
        if ($fotologo->isDirty('foto_path')) {
            Storage::disk('public')->delete($fotologo->getOriginal('foto_path'));
        }
    }

    /**
     * Handle the Fotologo "deleted" event.
     */
    public function deleted(Fotologo $fotologo): void
    {
        if (! is_null($fotologo->foto_path)) {
            Storage::disk('public')->delete($fotologo->foto_path);
        }
    }
}
