<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;

// Testing
use KasperKloster\MonkCommerce\Models\MonkCommerceShop;
use PDF;

class MonkAdminController extends Controller
{
    public function getAdminHomeIndex()
    {
      $pendingOrders = MonkCommerceOrder::where('order_status_id', 2)->count();
      return view('monkcommerce::monkcommerce-dashboard.admin.index')->with('pendingOrders', $pendingOrders);
    }


    public function getTesting()
    {

      $shop = MonkCommerceShop::first()->toArray();
      $order = MonkCommerceOrder::first()->toArray();

      $data = ['shop' => $shop, 'order' => $order];
      //https://github.com/barryvdh/laravel-dompdf
      //return view('monkcommerce::pdf.order')->with('shop', $shop)->with('order', $order);
      $pdf = PDF::loadView('monkcommerce::pdf.order', $data);
      return $pdf->save(storage_path('orders/order/invoice.pdf'));

    }

}
