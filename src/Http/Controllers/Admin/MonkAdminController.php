<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonkAdminController extends Controller
{
    public function getAdminHomeIndex()
    {
      return view('monkcommerce::monkcommerce-dashboard.admin.index');
    }
}
