<?php

namespace KasperKloster\MonkCommerce\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

// Mail
use Illuminate\Support\Facades\Mail;
use KasperKloster\MonkCommerce\Mail\NewOrderConfirmationMail;
use KasperKloster\MonkCommerce\Mail\NewOrderMailShop;

class NewOrderListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
      // Send Order Confirmation mail to customer
      Mail::to($event->customer->email)->send(new NewOrderConfirmationMail($event->customer, $event->customerDel, $event->cart, $event->order));
      // Send Mail to Shop
      Mail::to($event->shopEmail)->send(new NewOrderMailShop($event->customer, $event->customerDel, $event->cart, $event->order));
    }
}
