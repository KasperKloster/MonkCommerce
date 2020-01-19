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
use KasperKloster\MonkCommerce\Models\MonkCommerceShop;

// Classes / Repos
use KasperKloster\MonkCommerce\Repositories\MonkCommerceCart;
use KasperKloster\MonkCommerce\Repositories\MonkCommerceFilterSearch;

// Mails
use Illuminate\Support\Facades\Mail;
use KasperKloster\MonkCommerce\Mail\ContactFormMail;


class MonkStorefrontController extends Controller
{
    // Shop Main
    public function getShopIndex()
    {
      return view('monkcommerce::monkcommerce-storefront.shop.index');
    }

    public function anySingleCategory(Request $request, $slug)
    {

      // Find Category
      //$category = MonkCommerceProductCategory::where('slug', $slug)->with('products')->first();
      $category = MonkCommerceProductCategory::where('slug', $slug)->with('products')->first();

      // All Attributes with Values
      $allProductAttributes = MonkCommerceProductAttribute::with('attributeValues')->get();
      // Products
      $products = $category->products()
                  ->with('images')
                  ->with('attributeValues')
                  ->paginate(10);

      // Used if for checked in filter
      $setAttr = [];
      // If Filter
      if ($request->isMethod('post'))
      {
          $filter = new MonkCommerceFilterSearch;
          $filterReturn = $filter->productFilter($category, $request);
          $setAttr = $filterReturn['0'];
          $products = $filterReturn['1'];
      }

      // Return View
      return view('monkcommerce::monkcommerce-storefront.shop.categories.single_category')
              ->with('category', $category)
              ->with('products', $products)
              ->with('allProductAttributes', $allProductAttributes)
              ->with('setAttr', $setAttr);
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
      if ($page->is_contact == TRUE)
      {
        return view('monkcommerce::monkcommerce-storefront.static_pages.contact')->with('page', $page);
      }
      else
      {
        return view('monkcommerce::monkcommerce-storefront.static_pages.single_page')
              ->with('page', $page);
      }
    }

    public function postContactForm(Request $request)
    {
      /** Validate **/
      $request->validate([
        'firstName'       => 'required|min:1|max:200',
        'lastName'        => 'required|min:1|max:200',
        'email'           => 'required|email',
        'phone'           => 'required|integer|min:00000000|max:99999999|alpha_num',
        'subject'         => 'required|min:1|max:200',
        'message'         => 'required|min:2|max:2000',
      ]);

      $store = MonkCommerceShop::select('email', 'shop_name')->first();

      Mail::to($store->email)->send(new ContactFormMail($request, $store));


      return back()->with('success', 'Your message has been sent');

    }


    /*
    * Add / Remove Products from Cart
    */
    public function getAddToCart(Request $request, $id)
    {
      // Validate
      $request->validate([
        'id' => 'required|int',
      ]);

      // Find Product
      $product = MonkCommerceProduct::with('images')->with('attributeValues')->findOrFail($id)->toArray();

      // Check If Product is not in stock
      $productStock = MonkCommerceProduct::where('id', $id)->select('id', 'qty', 'slug')->first();
      if($productStock->qty <= '0')
      {
        return redirect()->route('monk-shop-single-product', $productStock->slug)->with('warning', 'Product is out of stock. Send us a message');
      }
      // Get Quantity
      if (!empty($request->quant[1]))
      {
        $request->validate([
          'quant' => 'required|array',
        ]);
        // Get Quantity from form
        $productQty = $request->quant[1];
      }
      else
      {
        // If not filled, set default qty to 1
        $productQty = 1;
      }

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

    public function getSearchResults(Request $request)
    {
      $search = new MonkCommerceFilterSearch;
      $searchResults = $search->navbarSearch($request);

      return view('monkcommerce::monkcommerce-storefront.shop.search-results')->with('searchResults', $searchResults);
    }

}
