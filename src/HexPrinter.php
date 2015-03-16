<?php namespace DebugHelper;

class HexPrinter
{
    /**
     * Pretty prints a binary string
     * @return string of hex + ascii values
     */
    public static function render($m, $rowLength = 16, $fillChar = ' ')
    {
        $j = 0;
        $bytes = '';
        $hex = '';
        $res = '';

        for ($i = 0; $i < strlen($m); $i++) {
            $x = substr($m, $i, 1);

            if (ord($x) > 30 && ord($x) < 0x80) {
                $bytes .= $x;
            } else {
                $bytes .= '.';
            }

            $hex .= bin2hex($x).$fillChar;

            if (++$j == $rowLength) {
                $j = 0;
                $res .= $hex.' '.$bytes.PHP_EOL;
                $bytes = '';
                $hex = '';
            }
        }

        if ($j) {
            $res .=
                $hex.' '.
                str_repeat(' ', ($rowLength - strlen($bytes)) * 3).
                $bytes.PHP_EOL;
        }

        return $res;
    }
}
