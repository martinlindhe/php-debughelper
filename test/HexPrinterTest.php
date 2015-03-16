<?php

class HexPrinterTest extends \PHPUnit_Framework_TestCase
{
    function test1()
    {
        $this->assertEquals(
            "68 65 6c 6c 6f                                   hello".PHP_EOL,
            \DebugHelper\HexPrinter::render('hello')
        );
    }
}
