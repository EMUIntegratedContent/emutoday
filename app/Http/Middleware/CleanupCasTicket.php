<?php

namespace Emutoday\Http\Middleware;

use Closure;

class CleanupCasTicket
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
        // If there's a ticket parameter in the URL, redirect to clean URL BEFORE processing
        if ($request->has('ticket')) {
            $cleanUrl = $request->url();
            return redirect($cleanUrl);
        }

        return $next($request);
    }
}
