<?php

namespace App\Observers;

use App\Models\Fotonamacover;
use Illuminate\Support\Facades\Storage;

class FotonamacoverObserver
{
    /**
     * Handle the Fotonamacover "created" event.
     */
    public function created(Fotonamacover $fotonamacover): void
    {
        //
    }

    /**
     * Handle the Fotonamacover "updated" event.
     */
    public function updated(Fotonamacover $fotonamacover): void
    {
        if ($fotonamacover->isDirty('foto_path')) {
            Storage::disk('public')->delete($fotonamacover->getOriginal('foto_path'));
        }
    }

    /**
     * Handle the Fotonamacover "deleted" event.
     */
    public function deleted(Fotonamacover $fotonamacover): void
    {
        if (! is_null($fotonamacover->foto_path)) {
            Storage::disk('public')->delete($fotonamacover->foto_path);
        }
    }

    /**
     * Handle the Fotonamacover "restored" event.
     */
    public function restored(Fotonamacover $fotonamacover): void
    {
        //
    }

    /**
     * Handle the Fotonamacover "force deleted" event.
     */
    public function forceDeleted(Fotonamacover $fotonamacover): void
    {
        //
    }
}
