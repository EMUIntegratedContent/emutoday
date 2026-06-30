<?php

namespace Emutoday\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Emutoday\User;
use Emutoday\Facades\Cas;

class Authenticate
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
    if (!Cas::isAuthenticated()) {
      // Store the intended URL for redirect after authentication
      session()->put('url.intended', $request->fullUrl());

      // API/XHR clients get a clean 401 rather than a CAS browser redirect.
      // (axios does not set X-Requested-With, so ajax() alone misses SPA calls.)
      if ($request->ajax() || $request->expectsJson() || $request->is('api/*')) {
        return response('Unauthorized.', 401);
      }
      Cas::authenticate();
    }

    $username = Cas::user() . '@emich.edu';

    $user = User::where('email', $username)->first();

    // Log in only once per session. Calling Auth::login() on every request runs
    // session()->migrate(true), which rotates the session id (and CSRF token) each
    // request and breaks the SPA's CSRF token. Re-login only if the session user no
    // longer matches the CAS user (account switch).
    if ($user && (!Auth::check() || Auth::id() !== $user->id)) {
      Auth::login($user, true);
    }
    session()->put('cas_user', Cas::user());

    return $next($request);
  }

  public function logout()
  {
    Cas::logout();
  }
}
