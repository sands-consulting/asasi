<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectToPending
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $vendor = Auth::guard($guard)->user()->vendor;

        if($vendor->status == 'pending' && !$request->is('vendors/*/pending'))
        {
            return redirect()->route('vendors.pending', $vendor->id);
        }

        return $next($request);
    }
}
