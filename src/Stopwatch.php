<?php namespace DebugHelper;

class Stopwatch
{
    /** @var Measure */
    protected $measure = null;

    /** @var string */
    protected $name;

    public function __construct($name = 'default')
    {
        $this->name = $name;
    }

    public function start()
    {
        $this->measure = new Measure;
        return $this;
    }

    public function startWithMessage($msg)
    {
        $this->printMessage($msg);

        $this->start();
    }

    public function stop()
    {
        $this->measure->stop();

        return $this->measure->getElapsedTime();
    }

    public function stopAndPrintResult($comment = '')
    {
        $this->stop();

        $this->printMessage(
            ($comment ? $comment.' ' : '')
            . number_format($this->measure->getElapsedTime(), 3)
            . ' seconds elapsed'
        );
    }

    public function printMessage($msg)
    {
        echo '[' . $this->name . '] ' . $msg . PHP_EOL;
    }

    function getElapsedTime()
    {
        return $this->measure->getElapsedTime();
    }
}
