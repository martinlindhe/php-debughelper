<?php namespace DebugHelper;

class Measure
{
    /** @var float */
    var $timeStart;

    /** @var float */
    var $timeStop;

    public function __construct()
    {
        $this->timeStart = microtime(true);
    }

    public function stop()
    {
        $this->timeStop = microtime(true);
    }

    public function getElapsedTime()
    {
        return $this->timeStop - $this->timeStart;
    }
}
