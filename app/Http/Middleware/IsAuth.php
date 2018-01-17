<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Redirect;
use Session;
use Closure;

class IsAuth
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
      if (!Session::has('user'))
      {
          return redirect::route('login.index');
      }

      return $next($request);
    }
}
