<?php

namespace Emutoday\Http\Middleware;

use Closure;

class EmailsMiddleware
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
        if (!$request->user()->isAdmin() &&  !$request->user()->isEmailBuilder())
        {
            // API/JSON clients get a clean 403; web pages get the flash + redirect.
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['error' => 'Forbidden'], 403);
            }
            $request->session()->flash('status', "You don't have permission to build emails");
            $request->session()->flash('alert-class', 'alert-danger');
            return redirect('admin/dashboard');
        }

        return $next($request);
    }
}
