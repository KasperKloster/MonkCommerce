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
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrderProduct;
// Repos
use KasperKloster\MonkCommerce\Repositories\MonkCommerceProcessOrder;

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
                ->with('orderCustomerDelivery')
                ->with('orderProduct')
                ->findOrFail($id);

      // Product cost (Without shipping)
      $productPrice = 0;
      foreach ($order->orderProduct as $product)
      {
        $productPrice += ($product->special_price ? $product->special_price * $product->pivot->qty : $product->price * $product->pivot->qty);
      }

      // For Status Select
      $status = MonkCommerceOrderStatus::all();
      // Return View
      return view('monkcommerce::monkcommerce-dashboard.admin.orders.order')
              ->with('order', $order)
              ->with('status', $status)
              ->with('productPrice', $productPrice);
    }

    public function update(Request $request, $id)
    {
      /*
      * Status Codes:
      * 1: New
      * 2: Pending
      * 3: Declined
      * 4: Sent
      */

      // Validate
      $request->validate([
        'status'  => 'required|integer',
      ]);

      // Different Stuff, Different Status Code
      // If Declined. Update db qty back.
      if($request->status == '3')
      {
        $proccessOrder = new MonkCommerceProcessOrder;
        $proccessOrder->declineOrder($id);
      }
      // If Sent, send email
      if($request->status == '4')
      {
        $proccessOrder = new MonkCommerceProcessOrder;
        $proccessOrder->sentOrder($id);
      }

      /** Update Status Code in Backend **/
      // Find Order Status
      $orderStatus = MonkCommerceOrder::where('id', $id)->with('orderProduct')->select('id', 'order_status_id')->get();
      // Loop Through Status and set qty
      foreach($orderStatus as $order)
      {
        // If Status was Declined, Update Stock qty
        if($order->order_status_id == '3')
        {
          foreach($order->orderProduct as $product)
          {
            $dbProducts = MonkCommerceProduct::find($product->id);
              // Can't Update if not in stock
              if ($dbProducts->qty < $product->pivot->qty)
              {
                Session::flash('warning', 'Can\'t update order. Not enough products in stock');
                return Redirect::route('monk-admin-orders-show', $id);
              }
            $dbProducts->qty = $dbProducts->qty - $product->pivot->qty;
            $dbProducts->update();
          }
        }
      }

      // Find Order and Update Status Code
      $order = MonkCommerceOrder::findOrFail($id);
      $order->order_status_id = $request->status;
      $order->updated_at      = NOW();
      $order->update();

      /* Message and Redirect */
      Session::flash('success', 'Order Has Been Updated');
      return Redirect::route('orders.index');
    }

    public function destroy($id)
    {
        //
    }
}
