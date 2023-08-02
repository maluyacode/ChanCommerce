<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CheckoutEvent;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;

class CheckoutListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(CheckoutEvent $event)
    {
        $order = $event->order;
        $email = $event->email;
        Mail::send(new OrderMail($email, $order));
    }
}
