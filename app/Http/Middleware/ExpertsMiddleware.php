<?php

namespace Emutoday\Http\Middleware;

use Closure;

class ExpertsMiddleware
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
        //Admins and experts editors may access everything within the scope of this Middleware, others may not
        if (!$request->user()->isAdmin() &&  !$request->user()->isExpertsEditor())
        {
            $request->session()->flash('status', "You don't have permission to manage experts");
            $request->session()->flash('alert-class', 'alert-danger');
            return redirect('admin/dashboard');
        }

        return $next($request);
    }
}
