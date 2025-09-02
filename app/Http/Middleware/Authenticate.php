<?php

/**
 * Created Sept 2, 2025 to replace the deprecated subfission/cas package with a custom Cas service, service provider, and facade.
 */

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
    if (! Cas::isAuthenticated()) {
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
