<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// Models
use KasperKloster\MonkCommerce\Models\MonkCommerceShipping;

class MonkAdminShippingSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('monkcommerce::monkcommerce-dashboard.admin.shop_settings.shipping.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
      * Display the specified resource.
      *
      * @param  \App\MonkCommerceShipping  $monkCommerceShipping
      * @return \Illuminate\Http\Response
      */
    // public function show(MonkCommerceShipping $monkCommerceShipping)
    // {
    //     //
    // }
    //
    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\MonkCommerceShipping  $monkCommerceShipping
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(MonkCommerceShipping $monkCommerceShipping)
    // {
    //     //
    // }
    //
    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\MonkCommerceShipping  $monkCommerceShipping
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, MonkCommerceShipping $monkCommerceShipping)
    // {
    //     //
    // }
    //
    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\MonkCommerceShipping  $monkCommerceShipping
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(MonkCommerceShipping $monkCommerceShipping)
    // {
    //     //
    // }
}
