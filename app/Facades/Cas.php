<?php

namespace Emutoday\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Cas
 * @package Emutoday\Facades
 * Facade for CAS authentication service
 */
class Cas extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cas';
    }
}

