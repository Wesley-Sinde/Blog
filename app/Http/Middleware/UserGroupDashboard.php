<?php

namespace App\Http\Middleware;

use Closure;

class UserGroupDashboard
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
        /*check user role & provide dash*/
        if(auth()->user()->hasRole('student'))
            return redirect()->route('user-student');

        if(auth()->user()->hasRole('guardian'))
            return redirect()->route('user-guardian');

        if(auth()->user()->hasRole('staff'))
            return redirect()->route('user-staff');

        return $next($request);
    }
}
