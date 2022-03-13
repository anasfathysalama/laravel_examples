<?php

namespace App\BackingClasses;


use Illuminate\Support\Str;

class Char
{

    public function convertToCamelCase(string $string): string
    {
        return Str::camel($string);
    }

}
