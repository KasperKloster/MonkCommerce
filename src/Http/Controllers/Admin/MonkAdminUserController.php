<?php

namespace KasperKloster\MonkCommerce\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
//use App\User;
use KasperKloster\MonkCommerce\Models\MonkCommereUser;

class MonkAdminUserController extends Controller
{
    public function index()
    {
      $users = MonkcommereUser::with('roles')->paginate(10);

      //
      // foreach($users as $user){
      //   echo $user->roles;
      // }
      //
      //
      // return 'none';

      return view('monkcommerce::monkcommerce-dashboard.admin.users.index')->with('users', $users);
    }
}
