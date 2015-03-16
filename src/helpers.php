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
