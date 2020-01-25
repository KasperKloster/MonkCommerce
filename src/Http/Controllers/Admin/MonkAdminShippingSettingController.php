<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use Redirect;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceShippingCourier;

class MonkAdminShippingSettingController extends Controller
{
    public function index()
    {
      $couriers = MonkCommerceShippingCourier::all();

      return view('monkcommerce::monkcommerce-dashboard.admin.shop_settings.shipping.index')->with('couriers', $couriers);
    }

    public function create()
    {
        return view('monkcommerce::monkcommerce-dashboard.admin.shop_settings.shipping.create');
    }

    public function store()
    {
        /* Store Courier Name */
        MonkCommerceShippingCourier::create($this->validateRequest());

        /* Message and Redirect */
        Session::flash('success', 'Courier Has Been Created');
        return Redirect::route('courier.index');
    }

    public function edit(MonkCommerceShippingCourier $courier)
    {
      return view('monkcommerce::monkcommerce-dashboard.admin.shop_settings.shipping.edit', compact('courier'));
    }

    public function update(MonkCommerceShippingCourier $courier)
    {
      /* Update Courier Name */
      $courier->update($this->validateRequest());

      /* Message and Redirect */
      Session::flash('success', 'Courier Has Been Updated');
      return Redirect::route('courier.index');
    }

    public function destroy(MonkCommerceShippingCourier $courier)
    {
      // Delete
      $courier->delete();
      // Message
      Session::flash('success', 'Courier Has Been Deleted');
      return Redirect::route('courier.index');
    }

    private function validateRequest()
    {
      return request()->validate([
        'name' => 'required|max:255|unique:mc_ship_couriers,name',
      ]);
    }
}
