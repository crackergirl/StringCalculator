<?php

namespace Deg540\PHPTestingBoilerplate;

use function PHPUnit\Framework\isEmpty;

class StringCalculator
{

    function add(String $stringNumbers):String{

        if ($stringNumbers == "") {

            return '0';
        }


        if ($this->isThereInvalidSeparators($stringNumbers,',','\n')) {

            return $this->errorMessageInInvalidSeparators($stringNumbers,',','\n');

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

    private function isThereInvalidSeparators(String $yourString,String $delimiter1,String $delimiter2){
        return  (strstr($yourString, $delimiter1.$delimiter2) == true | strstr($yourString, $delimiter2.$delimiter1 ) == true);
    }

    private function errorMessageInInvalidSeparators(String $yourString,String $delimiter1,String $delimiter2){

        $wrongDelimiterPosition = strpos($yourString, $delimiter1.$delimiter2);

        if ( $wrongDelimiterPosition  === false){

            $wrongDelimiterPosition  = strpos($yourString, $delimiter2.$delimiter1);
            $wrongDelimiterPosition  += 1;
            return "Number expected but '$delimiter1' found at position $wrongDelimiterPosition";
        }

        $wrongDelimiterPosition  += 1;
        return "Number expected but '$delimiter2' found at position $wrongDelimiterPosition";

    }

}