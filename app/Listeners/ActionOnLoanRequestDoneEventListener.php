<?php

namespace App\Listeners;

use App\Events\ActionOnLoanRequestDoneEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActionOnLoanRequestDoneEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ActionOnLoanRequestDoneEvent $event): void
    {

    }
}
