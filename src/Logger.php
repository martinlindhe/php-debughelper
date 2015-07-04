<?php namespace DebugHelper;

use Carbon\Carbon;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Class Logger
 * Writes debugging/development messages to screen (cli) or to error_log (from web)
 * @package DebugHelper
 */
class Logger
{
    /**
     * Yellow text
     * @param string $s
     */
    public static function dbg($s)
    {
        self::printMessage(self::withCallsite($s), 'comment');
    }

    /**
     * Green text
     * @param string $s
     */
    public static function nfo($s)
    {
        self::printMessage(self::withCallsite($s), 'info');
    }

    /**
     * White text on red background
     * @param string $s
     */
    public static function err($s)
    {
        self::printMessage(self::withCallsite($s), 'error');
    }

    /**
     * Yellow text with current time
     * @param string $s
     */
    public static function dbgTime($s)
    {
        self::printMessage('<' . Carbon::now()->toTimeString() . '> ' . self::withCallsite($s), 'comment');
    }

    /**
     * Green text with current time
     * @param string $s
     */
    public static function nfoTime($s)
    {
        self::printMessage('<' . Carbon::now()->toTimeString() . '> ' . self::withCallsite($s), 'info');
    }

    /**
     * White text on red background with current time
     * @param string $s
     */
    public static function errTime($s)
    {
        self::printMessage('<' . Carbon::now()->toTimeString() . '> ' . self::withCallsite($s), 'error');
    }

    /**
     * Also used by d()
     * @param string $s
     * @return string
     */
    public static function withCallsite($s)
    {
        $bt = debug_backtrace();

        $caller = null;
        do {
            $caller = array_shift($bt);

        } while ($caller && !empty($caller['class']) && $caller['class'] == 'DebugHelper\Logger');

        $file = isset($caller['file']) ? basename($caller['file']) : 'null';
        $line = isset($caller['line']) ? $caller['line'] : 'null';

        return '['.$file.':'.$line.'] '.$s;
    }

    private static function printMessage($s, $tag)
    {
        // TODO show if debug message toggle is on, configure per project using dotenv?
        if (PHP_SAPI === 'cli') {
            $output = new ConsoleOutput;
            $output->writeln('<'.$tag.'>' . $s . '</'.$tag.'>');
        } else {
            error_log(strtoupper($tag).': '.$s);
        }
    }
}
