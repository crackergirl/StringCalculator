<?php
declare(strict_types=1);
namespace Deg540\PHPTestingBoilerplate;

use phpDocumentor\Reflection\Types\Integer;
use function PHPUnit\Framework\isEmpty;

class StringCalculator
{

    private string $stringNumbers;
    private array $tipicalSeparators;
    private String $customSeparator;


    public function __construct(string $stringNumbers)
    {
        if($this->containsTheSeparator($stringNumbers)) {
            list($this->customSeparator, $this->stringNumbers) = explode('\n',substr($stringNumbers, 2));

        } else {
            $this->stringNumbers = $stringNumbers;
            $this->customSeparator = "";

        }
        $this->tipicalSeparators = array(',','\n');

    }

    public function add():string{

        if ($this->stringNumbers == "") {

            return '0';
        }

        $errorsText = $this->multipleErrors();
        if ($errorsText != ""){

            return rtrim($errorsText);
        }

        $intNumbers = ($this->customSeparator != "" ?
            $this->getIntegers($this->stringNumbers, array($this->customSeparator,'\n')) :
            $this->getIntegers($this->stringNumbers, $this->tipicalSeparators));


        return strval(array_sum($intNumbers));

    }

    public function multiply():string{

        if ($this->stringNumbers == "") {

            return '0';
        }

        $errorsText = $this->multipleErrors();
        if ($errorsText != ""){

            return rtrim($errorsText);
        }

        $intNumbers = ($this->customSeparator != "" ?
            $this->getIntegers($this->stringNumbers, array($this->customSeparator,'\n')) :
            $this->getIntegers($this->stringNumbers, $this->tipicalSeparators));


        return strval(array_product($intNumbers));

    }



    function addReturnsIntNumber(){

        $result = $this->add($this->stringNumbers);
        if (!is_numeric($result)){
            return  $result;
        }
        return intval($result);

    }

    private function multipleErrors():String{

        $errorsText = "";
        $auxTipicalSeparators = $this->tipicalSeparators;
        if ($this->customSeparator != ""){
            $invalidSeparatorText = $this->areThereAnyTipicalSeparatorInStringWithCustomSeparators($this->stringNumbers, $this->customSeparator ,$this->tipicalSeparators[0]);
            if ($invalidSeparatorText != "false"){
                $errorsText .= $invalidSeparatorText."\n";
            }
            $auxTipicalSeparators[0]= $this->customSeparator;
        }

        $numberOfSeparators = count($auxTipicalSeparators);

        for ( $separator1= 0;$separator1< $numberOfSeparators; ++$separator1){
            for ($separator2 = $separator1; $separator2 < $numberOfSeparators; ++$separator2){
                if ($this->areThereAnyUnexpectedSeparators($this->stringNumbers,$auxTipicalSeparators[$separator1],$auxTipicalSeparators[$separator2])) {
                    $result = $this->errorMessageInUnexpectedSeparators($this->stringNumbers,$auxTipicalSeparators[$separator1],$auxTipicalSeparators[$separator2]);
                    $errorsText .= $result."\n";
                }
            }
        }
        if ($this->isThereMissingNumberInLastPosition($this->stringNumbers,$auxTipicalSeparators[0])){
            $result = $this->errorMessageInMissingNumberInLastPosition();
            $errorsText .= $result."\n";
        }

        $intNumbers = $this-> getIntegers($this->stringNumbers, $auxTipicalSeparators);
        $negativeNumbers = $this->obtainNegativeNumbers($intNumbers);

        if ($this->areThereAnyNegativeNumber($negativeNumbers)){

            $result = $this->errorMessageInNegativeNumbers($negativeNumbers);

            $errorsText .= $result."\n";
        }

        return $errorsText;
    }

    private function getIntegers(String $yourString, $separators):array{

        $stringNumbers = str_replace($separators, $separators[0], $yourString);
        return array_map('intval', explode($separators[0],$stringNumbers));
    }

    private function containsTheSeparator(String $yourString): bool{

        return str_starts_with($yourString, '//');
    }

    private function obtainNegativeNumbers(array $numbers): array{

        $negativeNumbers = array_filter(
            $numbers,
            function($number) {
                return $number < 0;
            }
        );

        return $negativeNumbers;

    }

    private function areThereAnyNegativeNumber(array $negativeNumbers): bool{

        return count($negativeNumbers) > 0;
    }

    private function areThereAnyUnexpectedSeparators(String $yourString, String $separator1, String $separator2){
        return  (strstr($yourString, $separator1.$separator2) == true | strstr($yourString, $separator2.$separator1 ) == true);
    }

    private function areThereAnyTipicalSeparatorInStringWithCustomSeparators(String $yourString, String $customSeparator , $separator):String{

        if(strstr($yourString, $separator) == true) {

            return $this->errorMessageInInvalidSeparatorsInCustomSeparator($yourString, $customSeparator, $separator);
        }

        return  "false";
    }

    private function errorMessageInNegativeNumbers(array $negativeNumbers):String{
        return  sprintf('Negative not allowed : %s', implode(',', $negativeNumbers));
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