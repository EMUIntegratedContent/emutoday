<?php

/**
 * Created Sept 2, 2025 to replace the deprecated subfission/cas package with a custom Cas service, service provider, and facade.
 */
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
