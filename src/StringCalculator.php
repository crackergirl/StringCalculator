<?php

namespace Deg540\PHPTestingBoilerplate;

use function PHPUnit\Framework\isEmpty;

class StringCalculator
{

    function add(String $stringNumbers):String{

        if ($stringNumbers == "") {

            return '0';
        }

        if (str_starts_with($stringNumbers, '//')) {

           return $this->calculateAddWithOtherSeparator($stringNumbers);
        }

        if ($this->areThereInvalidSeparators($stringNumbers,',','\n')) {

            return $this->errorMessageInInvalidSeparators($stringNumbers,',','\n');

        }

        if ($this->isThereMissingNumberInLastPosition($stringNumbers,',')){

            return $this->errorMessageInMissingNumberInLastPosition();
        }

        $delimiters = [',', '\n'];
        return $this-> calculateAddWithSeparatorInTheString($stringNumbers, $delimiters);


    }

    private function calculateAddWithSeparatorInTheString(String $yourString, $delimiters):String{
        if (is_array($delimiters)){
            $stringNumbers = str_replace($delimiters, $delimiters[0], $yourString);
            $splitNumbers = explode($delimiters[0],$stringNumbers);

        }else{
            $splitNumbers = explode($delimiters,$yourString);
        }

        $resultAdd = 0;
        foreach ($splitNumbers as $number) {
            $resultAdd += intval($number);
        }
        return strval($resultAdd);
    }
    private function calculateAddWithOtherSeparator(String $yourString):String{

        $stringNumbers = substr($yourString, 2);
        $splitNumbers = explode('\n',$stringNumbers);
        return $this->calculateAddWithSeparatorInTheString($splitNumbers[1], $splitNumbers[0]);

    }

    private function areThereInvalidSeparators(String $yourString, String $delimiter1, String $delimiter2){
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

    private function isThereMissingNumberInLastPosition(String $yourString,String $separator){

        $lastChar = $yourString[-1];
        return  ( $lastChar == $separator);
    }
    private function errorMessageInMissingNumberInLastPosition(){

        return "Number expected but NOT found";
    }

}