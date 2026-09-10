<?php

namespace Emutoday\Http\Middleware;

use Closure;

class NoIndex
{
    /**
     * Add an X-Robots-Tag header so search engines drop the response from
     * their index. Used on API route groups that were being crawled/indexed
     * (e.g. /externalapi/*) even though they only return machine-readable JSON.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('X-Robots-Tag', 'noindex, nofollow');

        return $response;
    }
}
