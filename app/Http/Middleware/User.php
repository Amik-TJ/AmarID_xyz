<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->admin || auth()->user()->print_vendor || auth()->user()->delivery_vendor) {
            return redirect('login')->with('error',"Unauthorized access!");
        }
        return $next($request);
    }
}
