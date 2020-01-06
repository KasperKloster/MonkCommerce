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
    //$cart = json_decode(json_encode($items), true);
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
      'firstName'       => 'required|min:1|max:200',
      'lastName'        => 'required|min:1|max:200',
      'streetAddress'   => 'required',
      'postalCode'      => 'required|integer|min:0000|max:9999',
      'city'            => 'required',
      'country'         => 'required',
      'email'           => 'required|email',
      'phone'           => 'required|integer|min:00000000|max:99999999',
    ]);

    /** User Session **/

    return Redirect::route('monk-shop-checkout-delivery');
  }

  public function getCheckoutDelivery()
  {
    if (!Session::has('cart'))
    {
      return view('monkcommerce::monkcommerce-storefront.shop.cart.cart-index');
    }
    // Get Cart
    $oldCart = Session::get('cart');
    $cart = New MonkCommerceCart($oldCart);
    // Return View
    return view('monkcommerce::monkcommerce-storefront.shop.cart.checkout.checkout-delivery', ['products' => $cart->items, 'cart' => $cart]);
  }

  public function getCheckoutPayment()
  {
    return 'payment';
  }

  public function postCheckout(Request $request)
  {
    // Validate
    // $request->validate([
    //   'firstName'     => 'required|max:255',
    //   'lastName'      => 'required|max:255',
    //   'streetAddress' => 'required|max:555',
    //   'postalCode'    => 'required|max:9999',
    //   'city'          => 'required|max:355',
    //   'country'       => 'required|max:555',
    //   'phone'         => 'required|alpha_num',
    //   'email'         => 'required|email',
    // ]);

    $response = TRUE;

    if($response == True)
    {
      $order = new MonkCommerceProcessOrder;
      $order->createOrder($request);

      // Flush Cart Session
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
