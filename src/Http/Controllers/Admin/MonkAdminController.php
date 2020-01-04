<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;
use KasperKloster\MonkCommerce\Models\MonkCommerceShop;

class MonkAdminController extends Controller
{
    public function getAdminHomeIndex()
    {
      $pendingOrders = MonkCommerceOrder::where('order_status_id', 2)->count();
      return view('monkcommerce::monkcommerce-dashboard.admin.index')->with('pendingOrders', $pendingOrders);
    }
}
