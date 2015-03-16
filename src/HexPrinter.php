<?php namespace DebugHelper;

class HexPrinter
{
    /**
     * Prints hex dump of a binary string, similar to xxd
     * @param string $m
     * @param int $rowLength
     * @param string $fillChar
     * @return string of hex + ascii values
     */
    public static function render($m, $rowLength = 16, $fillChar = ' ')
    {
        $j = 0;
        $bytes = '';
        $hex = '';
        $res = '';
        $rowOffset = 0;

        for ($i = 0; $i < strlen($m); $i++) {
            $x = substr($m, $i, 1);

            if (ord($x) > 30 && ord($x) < 0x80) {
                $bytes .= $x;
            } else {
                $bytes .= '.';
            }

            $hex .= bin2hex($x).$fillChar;

            if (++$j == $rowLength) {
                $res .=
                    sprintf("%06x", $rowOffset).": "
                    .$hex.' '.$bytes.PHP_EOL;
                $rowOffset += $rowLength;
                $bytes = '';
                $hex = '';
                $j = 0;
            }
        }

        if ($j) {
            $res .=
                sprintf("%06x", $rowOffset).": "
                .$hex.' '
                .str_repeat(' ', ($rowLength - strlen($bytes)) * 3)
                .$bytes.PHP_EOL;
        }

        return $res;
    }
}
