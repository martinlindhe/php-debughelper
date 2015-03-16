<?php

class BinaryPrinterTest extends \PHPUnit_Framework_TestCase
{
    function test1()
    {
        $this->assertEquals(
            "000000: 11110000 11111111 00000000                 ...\n",
            \DebugHelper\BinaryPrinter::render("\xF0\xFF\x00")
        );
    }

}
