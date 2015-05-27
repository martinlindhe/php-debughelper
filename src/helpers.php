<?php

use DebugHelper\Logger;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;

if (!function_exists('d')) {
    /**
     * Dumps variable
     * @param $s
     * @throws Exception
     */
    function d($s)
    {
        $dumper = PHP_SAPI === 'cli' ? new CliDumper : new HtmlDumper;

        echo Logger::withBacktrace('');

        $dumper->dump((new VarCloner)->cloneVar($s));
    }
}

if (!function_exists('dd')) {
    /**
     * Dumps variable and die
     * @param $s
     */
    function dd($s)
    {
        d($s);
        die;
    }
}

if (!function_exists('dh')) {
    /**
     * Returns hex dump
     * @param string $s
     * @return string
     */
    function dh($s)
    {
        return \DebugHelper\HexPrinter::render($s);
    }
}

if (!function_exists('dbits')) {
    /**
     * Returns binary dump
     * @param string $s
     * @return string
     */
    function dbits($s)
    {
        return \DebugHelper\BinaryPrinter::render($s);
    }
}

if (!function_exists('bt')) {
    /**
     * Prints backtrace
     * @param Exception|null $ex
     */
    function bt(\Exception $ex = null)
    {
        if ($ex === null) {
            $bt = debug_backtrace();
        } else {
            $bt = $ex->getTrace();
        }

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

if (!function_exists('dm')) {
    /**
     * Prints current memory usage
     */
    function dm()
    {
        $used_mem = memory_get_peak_usage(false);
        echo 'Memory: using ' . round(($used_mem / 1024 / 1024), 1) . 'M';
        $memory_limit = ini_get('memory_limit');
        if ($memory_limit == '-1') {
            echo ' (no limit)' . PHP_EOL;
        } else {
            $limit = datasize_to_bytes($memory_limit);
            $pct = round($used_mem / $limit * 100, 1);
            $limit_s = round(($limit / 1024 / 1024), 1);
            echo ' (' . $pct . '% of ' . $limit_s . 'M)' . PHP_EOL;
        }
    }
}

if (!function_exists('apcm')) {
    /**
     * Prints memory usage by the apc extension
     * @throws Exception
     */
    function apcm()
    {
        if (!extension_loaded('apc')) {
            throw new \Exception('apc extension not loaded');
        }
        $info = apc_cache_info('', true);
        echo 'APC: using ' . round($info['mem_size'] / 1024 / 1024, 2) . 'M, '
            . $info['num_hits'] . ' hits, ' . $info['num_misses'] . ' misses, '
            . $info['num_entries'] . ' entries (max ' . $info['num_slots'] . ')' . PHP_EOL;
    }
}

if (!function_exists('datasize_to_bytes')) {
    /**
     * Converts strings like "128M" to bytes
     * @param string $str
     * @return int
     */
    function datasize_to_bytes($str)
    {
        $multiplier = 'B';
        $value = (int)$str;

        for ($i = 0; $i < strlen($str); $i++) {
            if (!is_numeric($str{$i})) {
                $value = (int)substr($str, 0, $i);
                $multiplier = strtoupper(substr($str, $i));
                break;
            }
        }

        $index = array_search($multiplier, ['B', 'K', 'M', 'G', 'T']);

        if ($index > 0) {
            return $value * pow(1024, $index);
        }

        return $value;
    }
}


if (!function_exists('dbg')) {
    /**
     * Prints debug message to console or error_log (from web)
     * @param string $s
     */
    function dbg($s)
    {
        Logger::dbg($s);
    }
}

if (!function_exists('nfo')) {
    /**
     * Prints info message to console or error_log (from web)
     * @param string $s
     */
    function nfo($s)
    {
        Logger::nfo($s);
    }
}

if (!function_exists('err')) {
    /**
     * Prints error message to console or error_log (from web)
     * @param string $s
     */
    function err($s)
    {
        Logger::err($s);
    }
}
