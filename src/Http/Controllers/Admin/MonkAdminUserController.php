<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use KasperKloster\MonkCommerce\Models\MonkCommerceUser;

class MonkAdminUserController extends Controller
{
    public function index()
    {
      $users = MonkCommerceUser::with('role')->paginate(10);
      return view('monkcommerce::monkcommerce-dashboard.admin.users.index')->with('users', $users);
    }
}
