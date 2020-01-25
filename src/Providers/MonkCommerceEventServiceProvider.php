<?php

namespace KasperKloster\MonkCommerce\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

// Events & Listeners
use KasperKloster\MonkCommerce\Events\CustomerPlacedOrderEvent;
use KasperKloster\MonkCommerce\Listeners\NewOrderListener;

class MonkCommerceEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
      CustomerPlacedOrderEvent::class => [
          NewOrderListener::class,
      ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
