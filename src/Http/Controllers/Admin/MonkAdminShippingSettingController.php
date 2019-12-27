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

    public function store(Request $request)
    {
        /* Validate */
        $request->validate([
          'courierName' => 'required|max:255|unique:mc_ship_couriers,courier',
        ]);

        /* Store Courier Name */
        $courier = new MonkCommerceShippingCourier;
        $courier->courier = $request->courierName;
        $courier->save();

        /* Message and Redirect */
        Session::flash('success', 'Courier Has Been Created');
        return Redirect::route('monk-admin-ship-index');
    }

    public function edit($id)
    {
      // Find Courier
      $courier = MonkCommerceShippingCourier::where('id', $id)->first();

      return view('monkcommerce::monkcommerce-dashboard.admin.shop_settings.shipping.edit')
              ->with('courier', $courier);

    }

    public function update(Request $request, $id)
    {
      /* Validate */
      $request->validate([
        'courierName' => 'required|max:255|unique:mc_ship_couriers,courier',
      ]);

      /* Store Courier Name */
      $courier = MonkCommerceShippingCourier::find($id);
      $courier->courier = $request->courierName;
      $courier->update();

      /* Message and Redirect */
      Session::flash('success', 'Courier Has Been Updated');
      return Redirect::route('monk-admin-ship-index');
    }

    public function destroy($id)
    {
      // Find Given Courier
      $courier = MonkCommerceShippingCourier::find($id);
      // Delete
      $courier->destroy($id);

      // Message
      Session::flash('success', 'Courier Has Been Deleted');
      return Redirect::route('monk-admin-ship-index');
    }
}
