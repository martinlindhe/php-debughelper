<?php namespace DebugHelper;

class BinaryPrinter
{
    /**
     * Prints base-2 (binary) representation of input string
     * @param string $m
     * @param int $rowLength
     * @param string $fillChar
     * @return string
     */
    public static function render($m, $rowLength = 8, $fillChar = ' ')
    {
        $j = 0;
        $bytes = '';
        $row = '';
        $res = '';
        $rowOffset = 0;

        for ($i = 0; $i < strlen($m); $i++) {
            $x = substr($m, $i, 1);

            if (ord($x) > 0x1F && ord($x) < 0x80)
                $bytes .= $x;
            else
                $bytes .= '.';

            $bin = sprintf("%08d", decbin(ord($x)));
            $row .= $bin.$fillChar;

            if (++$j == $rowLength) {
                $res .= sprintf("%06x", $rowOffset).": "
                    .$row.' '.$bytes.PHP_EOL;
                $rowOffset += $rowLength;
                $bytes = '';
                $row = '';
                $j = 0;
            }
        }

        if ($j) {
            $res .=
                sprintf("%06x", $rowOffset).": "
                .$row.' '
                .str_repeat(' ', ($rowLength - strlen($bytes)) * 3)
                .$bytes.PHP_EOL;
        }

        return $res;
    }
}
