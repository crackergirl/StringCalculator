<?php

namespace Deg540\PHPTestingBoilerplate;

use function PHPUnit\Framework\isEmpty;

class StringCalculator
{

    function add(String $stringNumbers):String{

        if ($stringNumbers == "") {

            return '0';
        }
        $tipicalSeparators = [',', '\n'];

        if (str_starts_with($stringNumbers, '//')) {

           return $this->calculateAddWithCustomSeparator($stringNumbers,$tipicalSeparators);
        }

        if ($this->areThereUnexpectedSeparators($stringNumbers,',','\n')) {

            return $this->errorMessageInUnexpectedSeparators($stringNumbers,',','\n');

        }

        if ($this->isThereMissingNumberInLastPosition($stringNumbers,',')){

            return $this->errorMessageInMissingNumberInLastPosition();
        }



        return $this-> calculateAddWithSeparatorsInTheString($stringNumbers, $tipicalSeparators);


    }

    private function calculateAddWithSeparatorsInTheString(String $yourString, $separators):String{
        if (is_array($separators)){
            $stringNumbers = str_replace($separators, $separators[0], $yourString);
            $splitNumbers = explode($separators[0],$stringNumbers);

        }else{
            $splitNumbers = explode($separators,$yourString);
        }

        $resultAdd = 0;
        $negativeNumbers = "";
        foreach ($splitNumbers as $number) {
            if (intval($number)< 0){
                $negativeNumbers .= $number.",";

            }
            $resultAdd += intval($number);
        }

        if ( $negativeNumbers != ""){
            $negativeNumbers = substr($negativeNumbers,0,strlen($negativeNumbers) - 1);
            return "Negative not allowed : ".$negativeNumbers;
        }
        return strval($resultAdd);
    }

    private function calculateAddWithCustomSeparator(String $yourString, $separators):String{

        $stringNumbers = substr($yourString, 2);
        $splitNumbers = explode('\n',$stringNumbers);
        $customSeparator = $splitNumbers[0];
        $allSplitNumbers = array_slice($splitNumbers, 1);
        $stringNumbers = implode($customSeparator , $allSplitNumbers );

        $invalidSeparatorText = $this->areThereTipicalSeparatorsInStringWithCustomSeparators($stringNumbers, $customSeparator ,$separators);

        if ($invalidSeparatorText != "false"){

            return $invalidSeparatorText ;
        }

        if ($this->isThereMissingNumberInLastPosition($stringNumbers, $customSeparator)){

            return $this->errorMessageInMissingNumberInLastPosition();
        }
        return $this->calculateAddWithSeparatorsInTheString($stringNumbers, $customSeparator);

    }

    private function areThereUnexpectedSeparators(String $yourString, String $separator1, String $separator2): bool{
        return  (strstr($yourString, $separator1.$separator2) == true | strstr($yourString, $separator2.$separator1 ) == true);
    }

    private function areThereTipicalSeparatorsInStringWithCustomSeparators(String $yourString,String $customSeparator ,$separators):String{

        foreach ($separators as $separator) {
            if(strstr($yourString, $separator) == true) {


                return $this->errorMessageInInvalidSeparatorsInCustomSeparator($yourString, $customSeparator, $separator);
            }
        }
        return  "false";
    }


    private function errorMessageInUnexpectedSeparators(String $yourString, String $separator1, String $separator2){

        $wrongDelimiterPosition = strpos($yourString, $separator1.$separator2);

        if ( $wrongDelimiterPosition  === false){

            $wrongDelimiterPosition  = strpos($yourString, $separator2.$separator1);
            $wrongDelimiterPosition  += 1;
            return "Number expected but '$separator1' found at position $wrongDelimiterPosition";
        }

        $wrongDelimiterPosition  += 1;
        return "Number expected but '$separator2' found at position $wrongDelimiterPosition";

    }
    private function errorMessageInInvalidSeparatorsInCustomSeparator(String $yourString, String $customSeparator , String $invalidSeparator){

        $wrongDelimiterPosition = strpos($yourString, $invalidSeparator);
        return "'$customSeparator' expected but '$invalidSeparator' found at position $wrongDelimiterPosition";
    }

    private function isThereMissingNumberInLastPosition(String $yourString,String $separator){

        $lastChar = $yourString[-1];
        return  ( $lastChar == $separator);
    }
    private function errorMessageInMissingNumberInLastPosition(){

        return "Number expected but NOT found";
    }

}