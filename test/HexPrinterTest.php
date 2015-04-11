<?php

class HexPrinterTest extends \PHPUnit_Framework_TestCase
{
    function test1()
    {
        $this->assertEquals(
            "000000: 68 65 6c 6c 6f                                   hello".PHP_EOL,
            \DebugHelper\HexPrinter::render('hello')
        );
    }

    function test2()
    {
        $this->assertEquals(
            "000000: f0 ff 00                                         ...".PHP_EOL,
            \DebugHelper\HexPrinter::render("\xF0\xFF\x00")
        );
    }
}
