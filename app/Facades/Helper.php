<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Helper extends Facade{

    protected static function getFacadeAccessor(): string
    {
        return 'helper';
    }

}
