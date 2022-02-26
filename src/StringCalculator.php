<?php

namespace Deg540\PHPTestingBoilerplate;

use function PHPUnit\Framework\isEmpty;

class StringCalculator
{

    function add(String $stringNumbers):String{

        if ($stringNumbers == "") {

            return '0';
        }

        $tipicalSeparators = array(',','\n');
        $errorsText = "";
        $areNotThereErrors = true;

        if (str_starts_with($stringNumbers, '//')) {

            $stringNumbersWithSeparator = substr($stringNumbers, 2);
            $splitNumbersWithSeparator = explode('\n',$stringNumbersWithSeparator);
            $customSeparator = $splitNumbersWithSeparator[0];
            $stringNumbers = $splitNumbersWithSeparator[1];

            $invalidSeparatorText = $this->areThereAnyTipicalSeparatorInStringWithCustomSeparators($stringNumbers, $customSeparator ,$tipicalSeparators[0]);
            if ($invalidSeparatorText != "false"){

                $errorsText .= $invalidSeparatorText."\n";
                $areNotThereErrors = false;
                return $invalidSeparatorText ;
            }
            $tipicalSeparators[0] = $customSeparator;

        }

        $numberOfSeparators = count($tipicalSeparators);
        for ( $separator1= 0;$separator1< $numberOfSeparators; ++$separator1){
            for ($separator2 = $separator1; $separator2 < $numberOfSeparators; ++$separator2){

                if ($this->areThereAnyUnexpectedSeparators($stringNumbers,$tipicalSeparators[$separator1],$tipicalSeparators[$separator2])) {

                    $result = $this->errorMessageInUnexpectedSeparators($stringNumbers,$tipicalSeparators[$separator1],$tipicalSeparators[$separator2]);
                    $areNotThereErrors = false;
                    $errorsText .= $result."\n";

                }

            }


        }

        if ($this->isThereMissingNumberInLastPosition($stringNumbers,$tipicalSeparators[0])){
            $result = $this->errorMessageInMissingNumberInLastPosition();
            $areNotThereErrors = false;
            $errorsText .= $result."\n";
        }

        $result = $this-> calculateAddWithSeparatorsInTheString($stringNumbers, $tipicalSeparators);
        if (is_numeric($result) && $areNotThereErrors ){
            return strval($result);
        }
        if (!is_numeric($result)){
            $errorsText .= $result."\n";
        }

        return rtrim($errorsText);

    }

    private function calculateAddWithSeparatorsInTheString(String $yourString, $separators):String{

        $stringNumbers = str_replace($separators, $separators[0], $yourString);
        $splitNumbers = explode($separators[0],$stringNumbers);

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

    private function areThereAnyUnexpectedSeparators(String $yourString, String $separator1, String $separator2): bool{
        return  (strstr($yourString, $separator1.$separator2) == true | strstr($yourString, $separator2.$separator1 ) == true);
    }

    private function areThereAnyTipicalSeparatorInStringWithCustomSeparators(String $yourString, String $customSeparator , $separator):String{

        if(strstr($yourString, $separator) == true) {

            return $this->errorMessageInInvalidSeparatorsInCustomSeparator($yourString, $customSeparator, $separator);
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