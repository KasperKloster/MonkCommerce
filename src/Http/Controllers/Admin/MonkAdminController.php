<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;

// Testing
//use KasperKloster\MonkCommerce\Models\MonkCommerceShop;
//use PDF;
// use App\User;
// use Auth;

class MonkAdminController extends Controller
{
    public function getAdminHomeIndex()
    {
      $pendingOrders = MonkCommerceOrder::where('order_status_id', 2)->count();
      return view('monkcommerce::monkcommerce-dashboard.admin.index')->with('pendingOrders', $pendingOrders);
    }



    // Testing
    public function getTesting()
    {

      // echo '<pre>';
      //
      //  var_dump(User::find(Auth::id())->roles);
      // echo '</pre>';
      //
      // foreach (User::find(Auth::id())->roles as $role)
      // {
      //   echo $role->pivot->role_id;
      // }

      // $shop = MonkCommerceShop::first()->toArray();
      // $order = MonkCommerceOrder::first()->toArray();
      //
      // $data = ['shop' => $shop, 'order' => $order];
      // //https://github.com/barryvdh/laravel-dompdf
      // //return view('monkcommerce::pdf.order')->with('shop', $shop)->with('order', $order);
      // $pdf = PDF::loadView('monkcommerce::pdf.order', $data);
      // return $pdf->save(storage_path('orders/order/invoice.pdf'));

    }

}
