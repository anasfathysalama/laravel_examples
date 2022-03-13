<?php

namespace Tests\Unit;

use App\BackingClasses\Char;
use PHPUnit\Framework\TestCase;

class CharTest extends TestCase
{



    public function testConvertStringToCamelCase(): void
    {
        $char = new Char();
        $value = $char->convertToCamelCase("new_class_name");
        self::assertEquals("newClassName", $value);
    }

}
