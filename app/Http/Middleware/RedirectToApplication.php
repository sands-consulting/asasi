<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectToApplication
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

        if(in_array($vendor->status, ['draft', 'rejected']))
        {
            return redirect()->route('vendors.edit', $vendor->id);
        }

        return $next($request);
    }
}
