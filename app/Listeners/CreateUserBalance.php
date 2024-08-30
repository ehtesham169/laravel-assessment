<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\UserBalance;

class CreateUserBalance
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        // Create a user balance with zero balance for the newly registered user
        UserBalance::create([
            'user_id' => $event->user->id,
            'balance' => 0,
        ]);
    }
}
