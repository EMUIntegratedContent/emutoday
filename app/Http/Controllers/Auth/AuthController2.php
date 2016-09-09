<?php
namespace Emutoday\Http\Controllers\Auth;

use Emutoday\User;
use Emutoday\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectAfterLogout = route('auth.login');
        $this->redirectTo = route('admin.dashboard');
        // $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->middleware('guest', ['except' => 'getLogout']);
    }

        public function authenticate()
        {
            if(Auth::attempt(['email'=> $email, 'password'=> $password])){
                //Authenticate passed
                return redirect()->intended('admin.dashboard');

            }
        }
}
