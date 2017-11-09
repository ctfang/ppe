<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2017/10/24
 * Time: 17:09
 */

namespace Framework\Support\Cli;


class Output
{
    public function send($str, $len, $color = 'blue')
    {
        $coun  = mb_strlen($str);
        $last  = $len - $coun;
        $space = '';
        for ($i = 0; $i < $last; ++$i) {
            $space .= ' ';
        }
        if( PHP_OS=='Linux' ){
            $objColour = new Color();
            return $objColour->getColoredString($str . $space,$color);
        }
        return $str . $space;
    }

    private function dump($arrTable)
    {

    }
}