<?php

namespace Emutoday\Http\Controllers\Auth;

use Emutoday\User;
use Validator;
use Emutoday\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    public function authenticate()
    {
        if(Auth::attempt(['email'=> $email, 'password'=> $password])){
            //Authenticate passed
            return redirect()->intended('admin.dashboard');

        }
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function guest(Request $request)
    { // Check LDAP, log in any valid NetId as guest
      $user = $request['user'];
      $pass = $request['password'];
      $base = 'ou=people,o=campus';

        if (empty($user) || empty($pass)) {
          return 'false inputs missing';
        } else {
          // $user = trim(strtolower(array_shift(explode('@', $user))));

          if ($conn = ldap_connect('ldap.emich.edu', 389)) {
            if (ldap_bind($conn, "cn={$user}," . $base, $pass)) {
              $search = ldap_search($conn, $base, "cn={$user}", array('EID'));

              if (ldap_count_entries($conn, $search) <= 0) {
                return 'false no entries';
              } else {
                return 'we got a match';//$user;
              }
            }
          }
        }
      return 'it didnt even';
    }
}
