<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginKontrol
{
     /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->input('age') < 200)
        {
            return redirect('auth/login');
        }
 
        return $next($request);
    }
 
}
