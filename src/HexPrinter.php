<?php namespace DebugHelper;

class HexPrinter
{
    /**
     * Prints hex dump of a binary string, similar to xxd
     * @param string $m
     * @param int $rowLength
     * @param string $fillChar
     * @param bool $showOffset
     * @return string of hex + ascii values
     */
    public static function render($m, $rowLength = 16, $fillChar = ' ', $showOffset = true)
    {
        $res = '';
        $rowOffset = 0;

        $bytes = '';
        $hex = '';
        $j = 0;

        for ($i = 0; $i < strlen($m); $i++) {
            $x = substr($m, $i, 1);

            $bytes .= self::decodeReadable($x);

            $hex .= bin2hex($x).$fillChar;

            if (++$j == $rowLength) {
                $res .=
                    ($showOffset ? sprintf("%06x", $rowOffset).": " : '')
                    .$hex.' '.$bytes.PHP_EOL;
                $rowOffset += $rowLength;
                $bytes = '';
                $hex = '';
                $j = 0;
            }
        }

        if ($j) {
            $res .=
                ($showOffset ? sprintf("%06x", $rowOffset).": " : '')
                .$hex.' '
                .str_repeat(' ', ($rowLength - strlen($bytes)) * 3)
                .$bytes.PHP_EOL;
        }

        return $res;
    }

    /**
     * @param string $c one byte
     * @return string
     */
    private static function decodeReadable($c)
    {
        if (ord($c) > 30 && ord($c) < 0x80) {
            return $c;
        }
        return '.';
    }
}
