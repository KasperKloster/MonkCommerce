<?php

namespace KasperKloster\MonkCommerce\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $store;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $store)
    {
      $this->request = $request;
      $this->store = $store;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('monkcommerce::emails.contact.contact-form')
                    ->from($this->request->email, $this->request->firstName . ' ' . $this->request->lastName)
                    ->subject($this->request->subject . ' | ' . $this->store->shop_name);
    }
}
