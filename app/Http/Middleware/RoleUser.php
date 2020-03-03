<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) return redirect('login');

        $access = Auth::user()->role_id;

        foreach($roles as $role) {
            if($access === (int) $role) return $next($request);
        }

        return abort(401);
    }
}
