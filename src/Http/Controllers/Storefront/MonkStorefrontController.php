<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Storefront;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;

// MODELS
use KasperKloster\MonkCommerce\Models\MonkCommerceProductcategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;
use KasperKloster\MonkCommerce\Models\MonkCommerceStaticPages;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttribute;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttributeValue;
use KasperKloster\MonkCommerce\Models\MonkCommerceCart;


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
    function addToCart(Request $request, $id)
    {
      // Find Product
      $product = MonkCommerceProduct::findOrFail($id);
      // Add to Cart Model and Session
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = New MonkCommerceCart($oldCart);
      $cart->add($product, $product->id);
      Session::put('cart', $cart);
      Session::flash('success', 'Product has been added to cart');
      return redirect()->back();
    }

    public function getCartIndex()
    {
      $oldCart = Session::get('cart');
      $cart = new MonkCommerceCart($oldCart);
      return view('monkcommerce::monkcommerce-storefront.shop.cart.cart-index',['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
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

      return view('monkcommerce::monkcommerce-storefront.shop.cart.checkout',['cart' => $cart, 'products' => $cart->items]);
    }

    public function postCheckout(Request $request)
    {
      // Validate
      $request->validate([
        'firstName' => 'required|int'
      ]);
      return back()->with('success', 'User created successfully.');
      //return $request;
    }
}
