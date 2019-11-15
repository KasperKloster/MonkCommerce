<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Storefront;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

// MODELS
use KasperKloster\MonkCommerce\Models\MonkCommerceProductcategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;
use KasperKloster\MonkCommerce\Models\MonkCommerceStaticPages;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttribute;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductAttributeValue;



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
}
