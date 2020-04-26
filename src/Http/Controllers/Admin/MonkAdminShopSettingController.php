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

    public function store(Request $request, MonkCommerceShop $shopSetting)
    {
      /* Validate and Store */
      $data = request()->validate([
        'name'                  => 'string|nullable',
        'street_address'        => 'string|nullable',
        'postal_code'           => 'string|nullable',
        'city'                  => 'string|nullable',
        'country'               => 'string|nullable',
        'phone'                 => 'nullable',
        'email'                 => 'email|nullable',
        'url'                   => 'string|nullable',
        'vat_number'            => 'string|nullable',
        'currency'              => 'required|string',
        'schema_currency'       => 'required|string',
        'prefix'                => 'string|nullable',
        'bambora_api'           => 'string|nullable',
        'bambora_merchant'      => 'string|nullable',
        'shipmondo_api'         => 'string|nullable',
        'cookie_msg'            => 'string|nullable',
      ]);
      MonkCommerceShop::first()->update($data);
      /* Message and Redirect */
      Session::flash('success', 'Shop Information has been updated');
      return Redirect::route('shop-setting.index');
    }
}
