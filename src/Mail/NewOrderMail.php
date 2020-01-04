<?php

namespace KasperKloster\MonkCommerce\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use KasperKloster\MonkCommerce\Models\MonkCommerceShop;

class NewOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $storeEmail = MonkCommerceShop::select('email')->first();

      return $this->from($storeEmail->email)
                  ->markdown('monkcommerce::emails.NewOrderMail');
    }
}
