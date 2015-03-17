<?php

use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;

if (!function_exists('d')) {
    function d($s)
    {
        $dumper = 'cli' === PHP_SAPI ? new CliDumper : new HtmlDumper;

        $dumper->dump((new VarCloner)->cloneVar($s));
    }
}

if (!function_exists('dd')) {
    function dd($s)
    {
        d($s);
        die;
    }
}

if (!function_exists('dh')) {
    function dh($s)
    {
        return \DebugHelper\HexPrinter::render($s);
    }
}

if (!function_exists('dbits')) {
    function dbits($s)
    {
        return \DebugHelper\BinaryPrinter::render($s);
    }
}


if (!function_exists('bt')) {
    /**
     * Prints backtrace
     */
    function bt()
    {
        $bt = debug_backtrace();

        foreach ($bt as $idx => $l) {
            if (!empty($l['class'])) {
                echo '(class '.$l['class'].') ';
            }
            if (!empty($l['object'])) {
                echo get_class($l['object']) . $l['type'];
            }
            echo $l['function'] .'(';
            $i = 0;

            foreach ($l['args'] as $arg) {
                $i++;
                if (is_object($arg)) {
                    echo gettype($arg).' '.get_class($arg);
                } else {
                    if (!is_array($arg)) {
                        echo $arg;
                    }
                }
                if ($i < count($l['args'])) {
                   echo ', ';
                }
            }
            echo ')';
            if (!empty($l['file'])) {
                echo ' from ' . $l['file'] . ':' . $l['line'];
            }
            echo PHP_EOL;
        }
    }
}
