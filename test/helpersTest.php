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

    function test_bt()
    {
     //   bt();
    }

    function test_dm()
    {
        dm();
    }

    function test_err()
    {
        err('error text');
    }

    function test_nfo()
    {
        nfo('info text');
    }

    function test_dbg()
    {
        dbg('debug text');
    }

    function test_datasize_to_bytes()
    {
        $this->assertEquals(1024, datasize_to_bytes('1k'));
        $this->assertEquals(1024*1024, datasize_to_bytes('1M'));
        $this->assertEquals(128*1024*1024, datasize_to_bytes('128M'));
    }
}
