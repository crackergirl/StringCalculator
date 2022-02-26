<?php

namespace Deg540\PHPTestingBoilerplate;

use function PHPUnit\Framework\isEmpty;

class StringCalculator
{

    function add(String $numbers):String{

        if ($numbers == "") {

            return '0';
        }
        return $numbers;

    }

}