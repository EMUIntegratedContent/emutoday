<?php

namespace Emutoday\Http\Middleware;

use Closure;

class IntcommMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Admins, editors, and contributors may access everything within the scope of this Middleware, others may not
        if (!$request->user()->hasIntcommAccess())
        {
            $request->session()->flash('status', "You don't have permission to access intcomm features.");
            $request->session()->flash('alert-class', 'alert-danger');
            return redirect('admin/dashboard');
        }

        return $next($request);
    }
}
