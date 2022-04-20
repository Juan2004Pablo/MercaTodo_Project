<?php

namespace App\Providers;

use App\Listeners\RegisteredEvent;
use App\Models\Product;
use App\Models\User;
use App\Observers\ModelObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
