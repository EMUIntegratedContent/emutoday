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

      if ($request->ajax()) {
        return response('Unauthorized.', 401);
      }
      Cas::authenticate();
    }

    $username = Cas::user() . '@emich.edu';

    $user = User::where('email', $username)->first();

    if ($user) {
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
