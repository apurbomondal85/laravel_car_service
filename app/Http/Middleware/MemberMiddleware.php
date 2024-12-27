<?php

namespace App\Http\Middleware;

use App\Library\Enum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            if(Auth::user()->user_type == Enum::USER_TYPE_MEMBER) {
                return $next($request);
            } else {
                return redirect('/');
            }

        } else {
            return redirect('/login')->with('message', 'Please Login to Access');
        }
    }
}
