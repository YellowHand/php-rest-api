<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthBasic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    Auth::routes(['signUp'=>false]);
    Auth::routes(['signIn'=>false]);
    Auth::routes(['register'=>false]);
    public function handle($request, Closure $next)
    {
        if(Auth::onceBasic()){
            return response()->json(['message' => 'Auth failed'], 401);
        }else{
            return $next($request);
        }
        
    }
}
