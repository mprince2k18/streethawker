<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserApproval
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
        if (Auth::user()->role == 3 ||Auth::user()->role == 2 && Auth::user()->approval == 2) {
            return $next($request);
        }
        elseif (Auth::user()->role == 3 ||Auth::user()->role == 2 && Auth::user()->approval == 1) {
            return redirect(url('notApproved'));
        }
        elseif (Auth::user()->role == 1 && Auth::user()->approval == 1 || Auth::user()->approval == 2) {
            return $next($request);
        }
        elseif (Auth::user()->approval == 0) {
            return redirect(url('Banded'));
        }
        elseif (Auth::user()->role > 3) {
            return abort(404);
        }
        else{
            // return redirect(url('Banded'));
            return abort(404);
        }
    }
}
