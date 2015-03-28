<?php namespace DebugHelper;

class Stopwatch
{
    /** @var Measure */
    protected $measure = null;

    protected $name;

    public function __construct($name = 'default')
    {
        $this->name = $name;
    }

    public function start()
    {
        $this->measure  = new Measure();
        return $this;
    }

    public function stop()
    {
        $this->measure->stop();
        return $this->measure->getElapsedTime();
    }

    public function stopAndPrintResult()
    {
        $this->stop();

        echo '['.$this->name.'] '.number_format($this->measure->getElapsedTime(), 4)." seconds elapsed\n";
    }

    function getElapsedTime()
    {
        return $this->measure->getElapsedTime();
    }
}
