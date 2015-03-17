<?php namespace DebugHelper;

class Stopwatch
{
    private $timeStart;
    private $timeStop;

    public function start()
    {
        $this->timeStart = microtime(true);
    }

    public function stop()
    {
        $this->timeStop = microtime(true);
        return $this->getElapsedTime();
    }

    function getElapsedTime()
    {
        return $this->timeStop - $this->timeStart;
    }
}
