<?php

namespace Deg540\PHPTestingBoilerplate;

use function PHPUnit\Framework\isEmpty;

class StringCalculator
{

    function add(String $stringNumbers):String{

        if ($stringNumbers == "") {

            return '0';
        }

        $splitNumbers = explode(",",$stringNumbers);

        $resultAdd = 0;
        foreach ($splitNumbers as $number) {
            $resultAdd += intval($number);
        }

        return strval($resultAdd);

    }

}