<?php

namespace App\Observers;

use App\Models\Fotopengantin;
use Illuminate\Support\Facades\Storage;

class FotopengantinObserver
{
    /**
     * Handle the Fotopengantin "created" event.
     */
    public function created(Fotopengantin $fotopengantin): void
    {
        //
    }

    /**
     * Handle the Fotopengantin "updated" event.
     */
    public function updated(Fotopengantin $fotopengantin): void
    {
        if ($fotopengantin->isDirty('foto_path')) {
            Storage::disk('public')->delete($fotopengantin->getOriginal('foto_path'));
        }
    }

    /**
     * Handle the Fotopengantin "deleted" event.
     */
    public function deleted(Fotopengantin $fotopengantin): void
    {
        if (! is_null($fotopengantin->foto_path)) {
            Storage::disk('public')->delete($fotopengantin->foto_path);
        }
    }

    /**
     * Handle the Fotopengantin "restored" event.
     */
    public function restored(Fotopengantin $fotopengantin): void
    {
        //
    }

    /**
     * Handle the Fotopengantin "force deleted" event.
     */
    public function forceDeleted(Fotopengantin $fotopengantin): void
    {
        //
    }
}
