<?php

return [

    // These CSS rules will be applied after the regular template CSS

    /*
        'css' => [
            '.button-content .button { background: red }',
        ],
    */

    'colors' => [

        'highlight' => '#004ca3',
        'button'    => '#004cad',

    ],

    'view' => [
        'senderName'  => null,
        'reminder'    => null,
        'unsubscribe' => 'https://atari.emich.edu/sympa/auto_signoff/emu-today',
        'address'     => null,

        'logo'        => [
            //'path'   => '%PUBLIC%/vendor/beautymail/assets/images/sunny/logo.png',
            'path'   => '%PUBLIC%/assets/imgs/email/email-logo.png',
            'path'   => '',
            'width'  => '',
            'height' => '',
        ],

        'twitter'  => null,
        'facebook' => null,
        'flickr'   => null,
    ],

];
