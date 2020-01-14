<?php

namespace KasperKloster\MonkCommerce\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use KasperKloster\MonkCommerce\Models\MonkCommerceShop;

class SentOrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $order;
    public $products;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $order, $products)
    {
        $this->customer = $customer;
        $this->order    = $order;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $store = MonkCommerceShop::select('email', 'shop_name')->first();

      return $this->markdown('monkcommerce::emails.orders.order-sent')
                  ->from($store->email, $store->shop_name)
                  ->subject($store->shop_name . ' | Your order has been shipped. Order ID: ' . $this->order->id);
    }
}
