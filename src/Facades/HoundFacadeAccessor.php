<?php

namespace filljoyner\HoundConnect\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class HoundFacadeAccessor
 *
 * @author   Philip Joyner  <@filljoyner>
 */
class HoundFacadeAccessor extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'filljoyner.hound';
    }
}
