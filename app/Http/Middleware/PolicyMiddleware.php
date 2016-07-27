<?php

namespace App\Http\Middleware;

use Closure;

class PolicyMiddleware
{
    protected $redirectTo = '/';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!app()->make('policy')->checkCurrentRoute()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()
                    ->to($this->redirectTo)
                    ->with('alert', trans('auth.unauthorized'));
            }
        }
        return $next($request);
    }
}
