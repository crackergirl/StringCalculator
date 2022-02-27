<?php
declare(strict_types=1);
namespace Deg540\PHPTestingBoilerplate;

use phpDocumentor\Reflection\Types\Integer;
use function PHPUnit\Framework\isEmpty;

class StringCalculator
{

    public function add(string $stringWithNumbers):string{

        $stringNumbers = new StringNumbers($stringWithNumbers);

        if ($stringWithNumbers == "") {

            return '0';
        }

        $errorsText = $stringNumbers->multipleErrors();
        if ($errorsText != ""){

            return rtrim($errorsText);
        }

        $intNumbers = $stringNumbers->getIntegers();


        return strval(array_sum($intNumbers));

    }

    public function multiply(string $stringWithNumbers):string{

        $stringNumbers = new StringNumbers($stringWithNumbers);

        if ($stringWithNumbers == "") {

            return '0';
        }

        $errorsText = $stringNumbers->multipleErrors();
        if ($errorsText != ""){

            return rtrim($errorsText);
        }

        $intNumbers = $stringNumbers->getIntegers();


        return strval(array_product($intNumbers));

    }



    function addReturnsIntNumber(string $stringWithNumbers){

        $result = $this->add($stringWithNumbers);
        if (!is_numeric($result)){
            return  $result;
        }
        return intval($result);

    }



}