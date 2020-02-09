<?php

namespace KasperKloster\MonkCommerce\Middleware;

use Closure;

use App\User;
use Auth;

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

      // If logged in
      if(Auth::check())
      {
        // Current User Role
        $userRoles = User::find(Auth::id())->roles;
        foreach ($userRoles as $role)
        {
          if ($role->pivot->role_id == '1')
          {
            return $next($request);
          }
          else
          {
            abort(403, 'Unauthorized action.');
          }
        }
      }
      else
      {
        abort(403, 'Unauthorized action.');
      }
    }
}
