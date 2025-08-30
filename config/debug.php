<?php

use Emutoday\User;
use Illuminate\Http\Request;

return [

    /*
    |--------------------------------------------------------------------------
    | Debug Censor
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, sensitive information may be
    | exposed in error reports. To prevent this, you may specify a list
    | of keys and classes that should be censored from all debug logs.
    |
    */

    'censor' => [
        // Censor data by its key...
        'key' => [
            'password',
            'password_confirmation',
            'current_password',
            'new_password',
        ],

        // Censor data by its class type...
        'class' => [
            User::class,
            Request::class,
        ],
    ],

];
