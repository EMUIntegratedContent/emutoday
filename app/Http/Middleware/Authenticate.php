<?php

namespace Emutoday\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Emutoday\User;

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
        
        if( ! cas()->isAuthenticated() )
        {
          if ($request->ajax()) {
            return response('Unauthorized.', 401);
          }
          cas()->authenticate();
        }
        
        $username = cas()->user() . '@emich.edu';
        
        $user = User::where('email', $username)->first();

        if( $user ){
          Auth::login($user, true);
        } 
        session()->put('cas_user', cas()->user() );

        return $next($request);
    }
    
    public function logout(){
        cas()->logout();
    }
}
