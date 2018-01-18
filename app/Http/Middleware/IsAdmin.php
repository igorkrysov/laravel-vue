<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Redirect;
use Session;
use Closure;

class IsAdmin
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
        if (Session::has('user')) {
            if (!(Session::get('user'))->is_admin()) {
                //  $user = Session::get('user');
                //  if($user->group->group != "administrator"){
                return redirect::back();
            }
        }

        return $next($request);
    }
}
