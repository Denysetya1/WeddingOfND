<?php

namespace App\Observers;

use App\Models\Fotoawal;
use Illuminate\Support\Facades\Storage;

class FotoawalObserver
{
    /**
     * Handle the Fotoawal "created" event.
     */
    public function created(Fotoawal $fotoawal): void
    {
        //
    }

    /**
     * Handle the Fotoawal "updated" event.
     */
    public function updated(Fotoawal $fotoawal): void
    {
        if ($fotoawal->isDirty('foto_path')) {
            Storage::disk('public')->delete($fotoawal->getOriginal('foto_path'));
        }
    }

    /**
     * Handle the Fotoawal "deleted" event.
     */
    public function deleted(Fotoawal $fotoawal): void
    {
        if (! is_null($fotoawal->foto_path)) {
            Storage::disk('public')->delete($fotoawal->foto_path);
        }
    }

    /**
     * Handle the Fotoawal "restored" event.
     */
    public function restored(Fotoawal $fotoawal): void
    {
        //
    }

    /**
     * Handle the Fotoawal "force deleted" event.
     */
    public function forceDeleted(Fotoawal $fotoawal): void
    {
        //
    }
}
