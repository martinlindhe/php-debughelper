<?php

class helpersTest extends \PHPUnit_Framework_TestCase
{
    function test_dbits()
    {
        $this->assertEquals(
            "000000: 11110000 11111111 00000000                 ...\n",
            dbits("\xF0\xFF\x00")
        );
    }

    function test_dh()
    {
        $this->assertEquals(
            "000000: f0 ff 00                                         ...".PHP_EOL,
            dh("\xF0\xFF\x00")
        );
    }

    function test_d()
    {
        d(['hej' => 11]);
    }

}
