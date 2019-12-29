<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Str;
use Session;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceOrder;

class MonkAdminOrdersController extends Controller
{
    public function index()
    {
      $orders = MonkCommerceOrder::paginate(5);

      return view('monkcommerce::monkcommerce-dashboard.admin.orders.index')
              ->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }
    //
    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    public function show($id)
    {
      $order = MonkCommerceOrder::find($id)->with('customer')->first();
      //$category = MonkCommerceProductCategory::where('slug', $slug)->with('products')->first();
      return view('monkcommerce::monkcommerce-dashboard.admin.orders.order')
              ->with('order', $order);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
