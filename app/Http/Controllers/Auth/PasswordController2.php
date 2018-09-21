<?php

namespace Emutoday\Http\Controllers\Auth;

use Emutoday\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{


    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('admin.dashboard');
        $this->middleware('guest');
    }

    protected function resetPassword($user, $password)
    {
        //$user->password = bcrypt($password);
        $user->password = $password;
        $user->save();

        auth()->login($user);
    }

}
