<?php

namespace Xiaowas\Nopasspay\Facades;

use Illuminate\Support\Facades\Facade;

class Nopasspay extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'nopasspay';
    }
}
