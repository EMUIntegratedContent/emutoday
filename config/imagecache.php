<?php
return array(
    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    |
    | {route}/{template}/{filename}
    |
    | Examples: "images", "img/cache"
    |
    */
    'route' => 'imagecache',
    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submited
    | by URI.
    |
    | Define as many directories as you like.
    |
    */
    'paths' => array(
        public_path('imgs'),
                public_path('imgs/story'),
                public_path('imgs/magazine'),
                public_path('imgs/user'),
                public_path('imgs/event'),
                public_path('imgs/placeholder'),
                public_path('imgs/expert'),
    ),
    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
    */
    'templates' => array(
        'small' => 'Intervention\Image\Templates\Small',
        'medium' => 'Intervention\Image\Templates\Medium',
        'large' => 'Intervention\Image\Templates\Large',
        'betterthumb' => 'Emutoday\Today\Filters\BetterThumb',
        'smallthumb' => 'Emutoday\Today\Filters\SmallThumb',
        'ddsmall' => 'Emutoday\Today\Filters\DDSmall',
        'ddfront' => 'Emutoday\Today\Filters\DDFront',
        'avatar160' => 'Emutoday\Today\Filters\Avatar160',
        'magazinecover' => 'Emutoday\Today\Filters\MagazineCover',
        'featuredevent' => 'Emutoday\Today\Filters\FeaturedEvent',
        'expertthumb' => 'Emutoday\Today\Filters\ExpertThumb',
        'expertmedium' => 'Emutoday\Today\Filters\ExpertMedium',
        'emailmain' => 'Emutoday\Today\Filters\EmailMain',
        'emailsub' => 'Emutoday\Today\Filters\EmailSub',
        'emu175' => 'Emutoday\Today\Filters\Emu175'
    ),
    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */
    'lifetime' => 43200,
);
