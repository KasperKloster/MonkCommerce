<?php

namespace KasperKloster\MonkCommerce\Repositories;
use Session;
// use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceOrderCustomer;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrderProduct;
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;

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
    // Getting cart from Session (price, sku etc. is stored from DB / so not possible to alter with html)
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
    // Events Mails

    // To New Session (orderUser)
    $this->order_id = $order->id;
  }

  public function declineOrder()
  {
    return 'none';
  }
}
