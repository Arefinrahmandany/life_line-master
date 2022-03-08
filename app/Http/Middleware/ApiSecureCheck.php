<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiSecureCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('Api-Secure-Key') == env('SECURE_API_KEY')) {
            return $next($request);
        }
        return response()->json(['code'=>401,'status'=>'Unauthorized','message'=>'Api Authorization Needed!'],401);
    }
}
