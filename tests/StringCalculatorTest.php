<?php

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;

final class StringCalculatorTest extends TestCase
{

    /**
     * @test
     */
    public function emptyStringReturnsZero(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add("");
        $this->assertEquals("0", $result);
    }

    /**
     * @test
     */
    public function stringOneReturnsOne(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add("1");
        $this->assertEquals("1", $result);
    }

    /**
     * @test
     */
    public function stringNumbersReturnsAdd(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add("0,1,2,4");
        $this->assertEquals("7", $result);
    }
    /**
     * @test
     */
    public function stringNumbersReturnsAddWithNewLineSeparator(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add('0\n1,2,4');
        $this->assertEquals("7", $result);
    }

}