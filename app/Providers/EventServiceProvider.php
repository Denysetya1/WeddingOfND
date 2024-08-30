<?php

namespace App\Providers;

use App\Models\Fotoawal;
use App\Models\Fotocover;
use App\Models\Fotologo;
use App\Models\Fotonamacover;
use App\Models\Fotopengantin;
use App\Models\Gallery;
use App\Observers\FotoawalObserver;
use App\Observers\FotocoverObserver;
use App\Observers\FotologoObserver;
use App\Observers\FotonamacoverObserver;
use App\Observers\FotopengantinObserver;
use App\Observers\GalleryObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Fotocover::observe(FotocoverObserver::class);
        Fotoawal::observe(FotoawalObserver::class);
        Fotologo::observe(FotologoObserver::class);
        Fotonamacover::observe(FotonamacoverObserver::class);
        Fotopengantin::observe(FotopengantinObserver::class);
        Gallery::observe(GalleryObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
