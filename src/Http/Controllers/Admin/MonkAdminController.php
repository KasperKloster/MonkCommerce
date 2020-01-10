<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;
use KasperKloster\MonkCommerce\Models\MonkCommerceShop;

// Testing mails
use KasperKloster\MonkCommerce\Mail\NewOrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
use KasperKloster\MonkCommerce\Models\MonkCommerceOrderCustomer;
use KasperKloster\MonkCommerce\Models\MonkCommerceProduct;
use Session;


class MonkAdminController extends Controller
{
    public function getAdminHomeIndex()
    {
      $pendingOrders = MonkCommerceOrder::where('order_status_id', 2)->count();
      return view('monkcommerce::monkcommerce-dashboard.admin.index')->with('pendingOrders', $pendingOrders);
    }

    public function getEmailTest()
    {

      $customer = MonkCommerceOrderCustomer::first();
      $customerDel  = MonkCommerceOrderCustomer::first();
      $cart = Session::get('cart');
      $order = MonkCommerceOrder::first();
      return new NewOrderConfirmationMail($customer, $customerDel, $cart, $order);
    }
}
