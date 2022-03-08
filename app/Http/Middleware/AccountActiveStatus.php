<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountActiveStatus
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
        if (Auth::check()) {
            if(auth()->user()->is_active == false)
            {
                toastr()->error('Your account is inactive, please contact admin', 'Account InActive');
                return redirect(route('error404'));
            }
        }

        return $next($request);
    }
}
