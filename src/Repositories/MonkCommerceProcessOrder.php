<?php

namespace KasperKloster\MonkCommerce\Repositories;
use Session;

// use Illuminate\Database\Eloquent\Model;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceOrderCustomer;
use KasperKloster\MonkCommerce\Models\MonkCommerOrderCustomerDelivery;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrderProduct;
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;
//use KasperKloster\MonkCommerce\Models\MonkCommerceShop;
// Mail
use Illuminate\Support\Facades\Mail;
use KasperKloster\MonkCommerce\Mail\SentOrderEmail;

// Events
use KasperKloster\MonkCommerce\Events\CustomerPlacedOrderEvent;

class MonkCommerceProcessOrder
{
  public function createOrder($request)
  {
    /* Create Customer / Billing */
    $bilSession = Session::get('billing');

    $customer = new MonkCommerceOrderCustomer;
    $customer->first_name     = $bilSession['firstName'];
    $customer->last_name      = $bilSession['lastName'];
    $customer->street_address = $bilSession['streetAddress'];
    $customer->postal_code    = $bilSession['postalCode'];
    $customer->city           = $bilSession['city'];
    $customer->country        = $bilSession['country'];
    $customer->phone          = $bilSession['phone'];
    $customer->email          = $bilSession['email'];
    $customer->save();

    /* Create Customer / Delivery */
    $delSession = Session::get('delivery');

    $customerDel = new MonkCommerOrderCustomerDelivery;
    $customerDel->first_name     = $delSession['dfirstName'];
    $customerDel->last_name      = $delSession['dlastName'];
    $customerDel->street_address = $delSession['dstreetAddress'];
    $customerDel->postal_code    = $delSession['dpostalCode'];
    $customerDel->city           = $delSession['dcity'];
    $customerDel->country        = $delSession['dcountry'];
    $customerDel->save();

    /* Create Order */
    $order = new MonkCommerceOrder;
    // new order is status code 1
    $order->order_status_id           = '1';
    // Get latest customer id (Created above)
    $order->order_customer_id          = $customer->id;
    $order->order_customer_delivery_id = $customerDel->id;
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

    /** Send Emails **/
    event(new CustomerPlacedOrderEvent(shopEmail(), $customer, $customerDel, $cart, $order));

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

  public function sentOrder($id)
  {
    // Finding Order
    $order = MonkCommerceOrder::findOrFail($id)->with('orderProduct')->first();
    // Find Customer Email
    $customer = MonkCommerceOrderCustomer::where('id', $order->order_customer_id)->select('id', 'email')->first();
    // Products Array
    $products = [];
    foreach($order->orderProduct as $product)
    {
      $products[] = $product;
    }
    // Send Email
    Mail::to($customer->email)->send(new SentOrderEmail($customer->toArray(), $order, $products));



  }


}
