<?php

namespace App\Providers;

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
        // Example:
        // \App\Events\NotificationCreated::class => [
        //     \App\Listeners\BroadcastNotification::class,
        // ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();

        // You can also register closures here if needed
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     * Recommended for production simplicity unless you want strict control.
     */
    public function shouldDiscoverEvents(): bool
    {
        return true;
    }
}