<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Guru
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
        // jika admin
        if(auth()->user()->level==2 || (auth()->user()->level==1)){
            return $next($request);
        }
        // jika bukan
        return redirect('/');
    }
}
