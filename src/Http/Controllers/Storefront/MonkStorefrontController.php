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
    * Add / Remove Products from Cart
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

}
