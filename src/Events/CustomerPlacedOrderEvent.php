<?php

namespace KasperKloster\MonkCommerce\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerPlacedOrderEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $customer;
    public $customerDel;
    public $cart;
    public $order;
    public $shopEmail;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($shopEmail, $customer, $customerDel, $cart, $order)
    {
        $this->customer = $customer;
        $this->customerDel = $customerDel;
        $this->cart = $cart;
        $this->order = $order;
        $this->shopEmail = $shopEmail;
    }

}
