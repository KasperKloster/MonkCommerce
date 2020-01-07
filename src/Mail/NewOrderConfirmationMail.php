<?php

namespace KasperKloster\MonkCommerce\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use KasperKloster\MonkCommerce\Models\MonkCommerceShop;

class NewOrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $customerDel;
    public $cart;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $customerDel, $cart, $order)
    {
        $this->customer = $customer;
        $this->customerDel = $customerDel;
        $this->cart = $cart;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $store = MonkCommerceShop::select('email', 'shop_name')->first();

      return $this->markdown('monkcommerce::emails.orders.new-order-confirmation-mail')
                  ->from($store->email, $store->shop_name)
                  ->subject($store->shop_name . ' | Order Confirmation. Order ID: ' . $this->order->id);
    }
}
