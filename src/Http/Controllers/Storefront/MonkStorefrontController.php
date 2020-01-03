<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Storefront;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use Redirect;

// MODELS
use KasperKloster\MonkCommerce\Models\MonkCommerceProductcategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;
use KasperKloster\MonkCommerce\Models\MonkCommerceStaticPages;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttribute;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttributeValue;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;

// Classes / Repos
use KasperKloster\MonkCommerce\Repositories\MonkCommerceCart;
use KasperKloster\MonkCommerce\Repositories\MonkCommerceProcessOrder;


class MonkStorefrontController extends Controller
{
    // Shop Main
    public function getShopIndex()
    {
      return view('monkcommerce::monkcommerce-storefront.shop.index');
    }

    public function getSingleCategory(Request $request, $slug)
    {
      // Find Category
      $category = MonkCommerceProductCategory::where('slug', $slug)->with('products')->first();
      // Return View
      return view('monkcommerce::monkcommerce-storefront.shop.categories.single_category')
              ->with('category', $category);
    }

    public function getSingleProduct(Request $request, $slug)
    {
      $product = MonkCommerceProduct::where('slug', $slug)
                  ->with('productCategories')
                  ->with('attributeValues')
                  ->with('images')
                  ->first();

      $value = MonkCommerceProductAttributeValue::with('attributes')->get();

      return view('monkcommerce::monkcommerce-storefront.shop.products.single_product')
            ->with('product', $product);
    }

    public function getSinglePage(Request $request, $slug)
    {
      $page = MonkCommerceStaticPages::where('slug', $slug)->first();
      return view('monkcommerce::monkcommerce-storefront.static_pages.single_page')
            ->with('page', $page);
    }

    /*
    * Cart
    */
    public function getAddToCart(Request $request, $id)
    {
      $request->validate([
        'quant' => 'required|array',
      ]);

      // Find Product and quantity
      $product = MonkCommerceProduct::with('images')->with('attributeValues')->findOrFail($id)->toArray();
      // Get Quantity
      $productQty = $request->quant[1];
      // Cart
      $oldCart = Session::has('cart') ? Session::get('cart') : NULL;
      $cart = new MonkCommerceCart($oldCart);
      // add cart from DB (Not possible to alter HTML)
      $cart->add($product, $id, $productQty);

      // Store in Session
      Session::put('cart', $cart);
      // View
      Session::flash('success', 'Product has been added to cart');
      return redirect()->back();
    }

    public function getRemoveFromCart($id)
    {
      // Cart
      $oldCart = Session::has('cart') ? Session::get('cart') : NULL;
      $cart = new MonkCommerceCart($oldCart);
      $cart->remove($id);
      // If Cart is completly empty. Remove Session
      if(empty($cart->items))
      {
        Session::forget('cart');
      }
      else
      {
        Session::put('cart', $cart);
      }

      // View
      Session::flash('success', 'Product has been removed from cart');
      return redirect()->back();
    }

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

    public function getCheckout()
    {
      if (!Session::has('cart'))
      {
        return view('monkcommerce::monkcommerce-storefront.shop.cart.cart-index');
      }
      // Get Cart
      $oldCart = Session::get('cart');
      $cart = New MonkCommerceCart($oldCart);

      return view('monkcommerce::monkcommerce-storefront.shop.cart.checkout', ['products' => $cart->items, 'cart' => $cart]);
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
      if (Session::has('orderUser'))
      {
        $orderUser = Session::get('orderUser');
        foreach($orderUser as $order)
        {
          // Find Order From DB
          $dbOrder = MonkCommerceOrder::where('id', $order)->with('orderCustomer')->with('orderProduct')->first();
        }
        return view('monkcommerce::monkcommerce-storefront.shop.cart.checkout-success')->with('dbOrder', $dbOrder);
      }
      else
      {
        return redirect()->back();
      }
    }
}
