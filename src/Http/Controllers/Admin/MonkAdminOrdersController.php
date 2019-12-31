<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Str;
use Session;

// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrderStatus;

class MonkAdminOrdersController extends Controller
{
    public function index()
    {
      $orders = MonkCommerceOrder::paginate(5);
      return view('monkcommerce::monkcommerce-dashboard.admin.orders.index')
              ->with('orders', $orders);
    }

    public function show($id)
    {
      // Find Order
      $order = MonkCommerceOrder::with('orderCustomer')
                ->with('orderProduct')
                ->findOrFail($id);
      // For Status Select
      $status = MonkCommerceOrderStatus::all();
      // Return View
      return view('monkcommerce::monkcommerce-dashboard.admin.orders.order')
              ->with('order', $order)
              ->with('status', $status);
    }

    public function update(Request $request, $id)
    {
      $request->validate([
        'status'  => 'required|integer',
      ]);

      // Find Order
      $order = MonkCommerceOrder::findOrFail($id)->first();
      $order->order_status_id = $request->status;
      $order->updated_at      = NOW();
      $order->update();

      /* Message and Redirect */
      Session::flash('success', 'Order Has Been Updated');
      return Redirect::route('monk-admin-orders-index');
    }

    public function destroy($id)
    {
        //
    }
}
