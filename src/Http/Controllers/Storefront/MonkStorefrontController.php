<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Storefront;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

// MODELS
use KasperKloster\MonkCommerce\Models\MonkCommerceProductcategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProductSubcategory;
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;

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
      return view('monkcommerce::monkcommerce-storefront.shop.categories.index')
              ->with('category', $category);
    }

    public function getSingleProduct(Request $request, $slug)
    {
      $product = MonkCommerceProduct::where('slug', $slug)->with('productCategories')->first();
      return view('monkcommerce::monkcommerce-storefront.shop.products.index')
            ->with('product', $product);
    }
}
