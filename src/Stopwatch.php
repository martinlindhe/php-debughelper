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

    public function stopAndPrintResult($comment = '')
    {
        $this->stop();

        echo '['.$this->name.'] '
            .($comment ? $comment.' ' : '')
            .number_format($this->measure->getElapsedTime(), 3)
            .' seconds elapsed'
            .PHP_EOL;
    }

    function getElapsedTime()
    {
        return $this->measure->getElapsedTime();
    }
}
