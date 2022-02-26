<?php

namespace Deg540\PHPTestingBoilerplate;

use function PHPUnit\Framework\isEmpty;

class StringCalculator
{

    function add(String $stringNumbers):String{

        if ($stringNumbers == "") {

            return '0';
        }


        if (strstr($stringNumbers, ',\n') | strstr($stringNumbers, '\n,')) {
            $pos = strpos($stringNumbers, ',\n');
            if ( $pos === false){
                $pos = strpos($stringNumbers, '\n,');
                return "Number expected but ',' found at position '$pos'";
            }else{
                return "Number expected but '\n' found at position '$pos' ";
            }


        }
        $delimiters = [',', '\n'];
        $stringNumbers = str_replace($delimiters, $delimiters[0], $stringNumbers);
        $splitNumbers = explode($delimiters[0],$stringNumbers);

        $resultAdd = 0;
        foreach ($splitNumbers as $number) {
            $resultAdd += intval($number);
        }

        return strval($resultAdd);

    }

}