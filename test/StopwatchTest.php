<?php

use DebugHelper\Stopwatch;

class StopwatchTest extends \PHPUnit_Framework_TestCase
{
    function test1()
    {
        $watch = (new Stopwatch())->start();
        usleep(100000);
        $watch->stop();

        $this->assertEquals(0.1, round($watch->getElapsedTime(), 1));
    }

    function testMulti()
    {
        $one = (new Stopwatch('one'))->start();
        usleep(100000);

        $two = (new Stopwatch('two'))->start();

        $one->stopAndPrintResult();
        usleep(10);

        $two->stopAndPrintResult();
    }
}
