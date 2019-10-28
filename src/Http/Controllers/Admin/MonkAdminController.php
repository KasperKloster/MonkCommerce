<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use KasperKloster\MonkCommerce\Models\MonkcommerceProductAttribute;
use KasperKloster\MonkCommerce\Models\MonkcommerceProductAttributeValue;



class MonkAdminController extends Controller
{
    public function getAdminHomeIndex()
    {

      $attributes = MonkcommerceProductAttribute::with('productAttributeValues')->get();
      // //$values = MonkcommerceProductAttributeValue::all();
      //
      // //dd($values);


      return view('monkcommerce::monkcommerce-dashboard.admin.index')->with('attributes',$attributes);
    }
}
