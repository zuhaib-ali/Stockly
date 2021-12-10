<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccountantAuth
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
        if(!$request->session()->has("user")){
            return redirect()->route("login");
        }
        if($request->session()->get('user')->role == 'accountant'){
            return $next($request);    
        }else{
            return back();
        }
        
    }
}
