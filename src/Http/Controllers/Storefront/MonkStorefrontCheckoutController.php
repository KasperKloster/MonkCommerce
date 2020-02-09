<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Storefront;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use Redirect;

// MODELS
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;

// Classes / Repos
use KasperKloster\MonkCommerce\Repositories\MonkCommerceCart;
use KasperKloster\MonkCommerce\Repositories\MonkCommerceProcessOrder;

class MonkStorefrontCheckoutController extends Controller
{

  /*
  * Cart and Checkout
  */
  public function getCartIndex()
  {
    if (!Session::has('cart'))
    {
      return view('monkcommerce::monkcommerce-storefront.shop.cart.cart-index');
    }
    // Get items
    $cart = Session::get('cart');
    return view('monkcommerce::monkcommerce-storefront.shop.cart.cart-index', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
  }

  public function getCheckoutBilling()
  {
    if (!Session::has('cart'))
    {
      return view('monkcommerce::monkcommerce-storefront.shop.cart.cart-index');
    }
    // Get Cart
    $oldCart = Session::get('cart');
    $cart = New MonkCommerceCart($oldCart);
    // Return View
    return view('monkcommerce::monkcommerce-storefront.shop.cart.checkout.checkout-billing', ['products' => $cart->items, 'cart' => $cart]);
  }

  public function postCheckoutBilling(Request $request)
  {
    /** Validate **/
    $request->validate([
      'first_name'        => 'required|min:1|max:200',
      'last_name'         => 'required|min:1|max:200',
      'street_address'    => 'required|max:555',
      'postal_code'       => 'required|integer|min:0000|max:9999',
      'city'              => 'required|max:555',
      'country'           => 'required|max:555',
      'email'             => 'required|email',
      'phone'             => 'required|integer|min:00000000|max:99999999|alpha_num',
      'user'              => 'int|max:1',
    ]);
    // User input to session
    Session::put('billing', $request->all());
    // redirect to delivery
    return Redirect::route('monk-shop-checkout-delivery');
  }

  public function getCheckoutDelivery()
  {
    if (!Session::has('cart') && Session::get('billing'))
    {
      return view('monkcommerce::monkcommerce-storefront.shop.cart.cart-index');
    }
    // Get Cart
    $oldCart = Session::get('cart');
    $cart = New MonkCommerceCart($oldCart);
    // Return View
    return view('monkcommerce::monkcommerce-storefront.shop.cart.checkout.checkout-delivery', ['products' => $cart->items, 'cart' => $cart]);
  }

  public function postCheckoutDelivery(Request $request)
  {

    /** Validate **/
    $request->validate([
      'first_name'       => 'required|min:1|max:200',
      'last_name'        => 'required|min:1|max:200',
      'street_address'   => 'required|max:555',
      'postal_code'      => 'required|integer|min:0000|max:9999',
      'city'             => 'required|max:555',
      'country'          => 'required|max:555',
    ]);
    Session::put('delivery', $request->all());

    return Redirect::route('monk-shop-checkout-payment');
  }

  public function getCheckoutPayment()
  {
    if (!Session::has('cart') && Session::get('billing') && Session::get('delivery'))
    {
      return view('monkcommerce::monkcommerce-storefront.shop.cart.cart-index');
    }
    // Get Cart
    $oldCart = Session::get('cart');
    $cart = New MonkCommerceCart($oldCart);
    // Return View
    return view('monkcommerce::monkcommerce-storefront.shop.cart.checkout.checkout-payment', ['products' => $cart->items, 'cart' => $cart]);
  }

  public function postCheckoutPayment(Request $request)
  {
    /** Validate **/
    $request->validate([
      'cc-name'       => 'required',
      'cc-number'     => 'required',
      'cc-expiration' => 'required',
      'cc-cvv'        => 'required',
    ]);

    // DEVELOPMENT PAYMENT RESPONSE MAYBE NO SESSION
    // Save to Session
    Session::flash('payment', $request->all());
    $response = TRUE;

    if($response == True)
    {
      $order = new MonkCommerceProcessOrder;
      $order->createOrder($request);
      // Flush Cart Session (ALL?)
      Session::flush('cart');
      // New Session for Success Page
      Session::put('orderUser', $order);
      // Redirect
      return Redirect::route('monk-shop-checkout-success');
    }
    else
    {
      return 'something as wrong...';
    }

  }

  public function getCheckoutSuccess()
  {
    // If Session Exists, Get it. Else Redirect Back.
    $orderUser = Session::has('orderUser') ? Session::get('orderUser') : redirect()->back();
    // Loop through User Session
    foreach($orderUser as $order)
    {
      // Find Order From DB
      $dbOrder = MonkCommerceOrder::where('id', $order)->with('orderCustomer')->with('orderProduct')->first();
    }
    // Return View
    return view('monkcommerce::monkcommerce-storefront.shop.cart.checkout-success')->with('dbOrder', $dbOrder);
  }
}
