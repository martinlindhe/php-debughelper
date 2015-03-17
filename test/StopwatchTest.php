<?php

class StopwatchTest extends \PHPUnit_Framework_TestCase
{
    function test1()
    {
        $watch = new \DebugHelper\Stopwatch();
        $watch->start();
        usleep(100000);
        $watch->stop();

        $this->assertEquals(0.1, round($watch->getElapsedTime(), 1));
    }
}
