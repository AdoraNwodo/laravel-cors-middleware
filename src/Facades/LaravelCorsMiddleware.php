<?php

namespace AdoraNwodo\LaravelCorsMiddleware\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelCorsMiddleware extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelcorsmiddleware';
    }
}
