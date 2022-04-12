<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\RegisteredEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\User;
use App\Observers\ModelObserver;
use App\Models\Product;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Registered::class => [
            RegisteredEvent::class,
        ],
    ];

    public function boot(): void
    {
        User::observe(ModelObserver::class);
        Product::observe(ModelObserver::class);
        parent::boot();
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
