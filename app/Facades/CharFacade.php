<?php

namespace App\Facades;

use App\BackingClasses\Char;
use Illuminate\Support\Facades\Facade;

class CharFacade extends Facade
{

    /**
     * Class CharFacade
     * @method static String convertToCamelCase(String $string);
     * @package App\Facades
     */
    protected static function getFacadeAccessor(): string
    {
        return Char::class;
    }

}
