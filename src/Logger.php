<?php namespace DebugHelper;

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
        self::printMessage(self::withBacktrace($s), 'comment');
    }

    /**
     * Green text
     * @param string $s
     */
    public static function nfo($s)
    {
        self::printMessage(self::withBacktrace($s), 'info');
    }

    /**
     * White text on red background
     * @param string $s
     */
    public static function err($s)
    {
        self::printMessage(self::withBacktrace($s), 'error');
    }

    private static function withBacktrace($s)
    {
        $bt = debug_backtrace();

        $caller = null;
        do {
            $caller = array_shift($bt);

        } while ($caller && in_array(basename($caller['file']), ['withBacktrace', 'err', 'nfo', 'dbg']));

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
