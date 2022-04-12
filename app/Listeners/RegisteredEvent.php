<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class RegisteredEvent
{
    public function handle(Registered $event): void
    {
        $event->user->roles()->sync([2]);
    }
}
