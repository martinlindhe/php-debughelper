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
        self::printMessage($s, 'comment');
    }

    /**
     * Green text
     * @param string $s
     */
    public static function nfo($s)
    {
        self::printMessage($s, 'info');
    }

    /**
     * White text on red background
     * @param string $s
     */
    public static function err($s)
    {
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        if (basename($caller['function']) == 'err') {
            $caller = array_shift($bt);
        }

        // try to strip useless part of path
        $pwd = getenv('PWD').'/';
        $file = str_replace($pwd, '', $caller['file']);

        $s = '['.$file.':'.$caller['line'].'] '.$s;

        self::printMessage($s, 'error');
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
