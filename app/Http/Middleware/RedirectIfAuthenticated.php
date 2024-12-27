<?php

namespace App\Http\Middleware;

use App\Library\Enum;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                if(Auth::user()->user_type == Enum::USER_TYPE_ADMIN) {
                    return redirect(RouteServiceProvider::HOME);
                } elseif(Auth::user()->user_type == Enum::USER_TYPE_MEMBER) {
                    return redirect()->route('public.member.dashboard.index');
                }

            }
        }

        return $next($request);
    }
}
