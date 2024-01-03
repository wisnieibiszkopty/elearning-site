<?php

namespace App\Helper;

use Illuminate\Support\Facades\Facade;

class HelperFacade extends Facade{

    protected static function getFacadeAccessor(): string
    {
        return 'helper';
    }

}
