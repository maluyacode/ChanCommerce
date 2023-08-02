<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderConfirmEvent;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class OrderConfirmListener
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
    public function handle(OrderConfirmEvent $event): void
    {
        Mail::send(new OrderConfirmation($event->email, $event->order));
    }
}
