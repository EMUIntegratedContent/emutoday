<?php

namespace Emutoday\Http\Middleware;

use Closure;

class StoryIdeaMiddleware
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
        if (!$request->user()->isAdmin() &&  !$request->user()->isEditor())
        {
            $request->session()->flash('status', "You must have the role of 'editor' or greater to use this feature.");
            $request->session()->flash('alert-class', 'alert-danger');
            return redirect('admin/dashboard');
        }

        return $next($request);
    }
}
