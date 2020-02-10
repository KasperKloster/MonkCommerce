<?php

namespace KasperKloster\MonkCommerce\Middleware;

use Closure;

use Auth;
use KasperKloster\MonkCommerce\Models\MonkCommerceUser;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      // Check If logged in
      if(Auth::check())
      {
        // Get Current User Role
        $userRole = MonkCommerceUser::find(Auth::id())->role_id;
        // Return next if user role is admin (1)
        if($userRole == '1')
        {
          return $next($request);
        }
        else
        {
          abort(403, 'Unauthorized action.');
        }
      }
    }
}
