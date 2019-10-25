<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Str;
use Session;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceShop;

class MonkAdminShopSettingController extends Controller
{
    // Shop Settings
    public function index()
    {
      $shop = MonkCommerceShop::first();
      return view('monkcommerce::monkcommerce-dashboard.admin.shop_settings.shop_settings')
              ->with('shop', $shop);
    }

    public function store(Request $request)
    {
      // Validation
      $request->validate([
        'shop_name'       => 'required|string',
        'shop_val'        => 'required|integer',
        'street_address'  => 'required',
        'postal_code'     => 'required',
        'city'            => 'required|string',
        'country'         => 'required',
        'phone'           => 'nullable',
        'email'           => 'email',
        'url'             => 'string',
        'vat_number'      => 'string',
      ]);

      /*
      * Store Shop
      */
      $shop = MonkCommerceShop::find($request->shop_val);
      $shop->shop_name       = $request->shop_name;
      $shop->street_address  = $request->street_address;
      $shop->postal_code     = $request->postal_code;
      $shop->city            = $request->city;
      $shop->country         = $request->country;
      $shop->phone           = $request->phone;
      $shop->email           = $request->email;
      $shop->url             = $request->url;
      $shop->vat_number      = $request->vat_number;
      $shop->update();

      /*
      * Message and Redirect
      */
      Session::flash('success', 'Shop Information has been updated');
      return Redirect::route('monk-admin-shop-settings');

    }
}
