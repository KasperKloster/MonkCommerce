<?php

namespace KasperKloster\MonkCommerce\Repositories;
use Session;

// use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceOrderCustomer;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrderProduct;
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;
// Mail
use Illuminate\Support\Facades\Mail;
use KasperKloster\MonkCommerce\Mail\NewOrderConfirmationMail;

class MonkCommerceProcessOrder
{
  public function createOrder($request)
  {
    /* Create Customer */
    $customer = new MonkCommerceOrderCustomer;
    $customer->first_name     = $request->firstName;
    $customer->last_name      = $request->lastName;
    $customer->street_address = $request->streetAddress;
    $customer->postal_code    = $request->postalCode;
    $customer->city           = $request->city;
    $customer->country        = $request->country;
    $customer->phone          = $request->phone;
    $customer->email          = $request->email;
    $customer->save();

    /* Create Order */
    $order = new MonkCommerceOrder;
    // new order is status code 1
    $order->order_status_id = '1';
    // Get latest customer id (Created above)
    $order->order_customer_id = $customer->id;
    $order->save();

    /* Create Products */
    // Getting cart from Session (price, sku etc. is stored from DB / so not possible to alter data with html)
    $cart = Session::get('cart');
    foreach ($cart->items as $product)
    {
      // Create Order
      $orderProduct = new MonkCommerceOrderProduct;
      $orderProduct->order_id   = $order->id;
      $orderProduct->product_id = $product['item']['id'];
      $orderProduct->qty        = $product['qty'];
      $orderProduct->save();
      // Update DB Product Qty (Main). Remove from Stock If declined put back in
      $dbProduct = MonkCommerceProduct::where('id', $product['item']['id'])->first();
      $dbProduct->qty = $dbProduct->qty - $product['qty'];
      $dbProduct->save();
    }

    // Send New Order Mail
    Mail::to($customer->email)->send(new NewOrderConfirmationMail($customer->toArray(), $cart, $order));

    // To New Session (orderUser)
    $this->order_id = $order->id;
  }

  public function declineOrder($id)
  {
    // Finding Order
    $order = MonkCommerceOrder::findOrFail($id);
    $orderProducts = $order->orderProduct()
        ->wherePivot('order_id', '=', $id)
        ->get(); // execute the query
    // Find each $dbProduct and update qty back
    foreach($orderProducts as $orderProduct)
    {
      $dbProduct = MonkCommerceProduct::find($orderProduct->id);
      $dbProduct->qty = $orderProduct->qty + $orderProduct->pivot->qty;
      $dbProduct->update();
    }

  }
}
