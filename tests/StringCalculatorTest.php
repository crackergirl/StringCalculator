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
    /**
     * @test
     */
    public function stringNumbersWithInvalidSeparators(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add('0,2,\n4');
        $delimiter = '\n';
        $this->assertEquals("Number expected but '$delimiter' found at position 4", $result);
    }

    /**
     * @test
     */
    public function missingNumberInLastPosition(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add('0,2,4,');
        $this->assertEquals("Number expected but NOT found",$result);
    }

    /**
     * @test
     */
    public function stringNumbersReturnsAddWithCustomSeparator(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add('//;\n1;2;4');
        $this->assertEquals("7", $result);
    }

    /**
     * @test
     */
    public function stringNumbersWithInvalidSeparatorsInCustomSeparator(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add('//;\n1;2,4');
        $this->assertEquals("';' expected but ',' found at position 3", $result);
    }
    /**
     * @test
     */
    public function stringNumbersWithNegativeNumbers(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add("0,-1,2,-4");
        $this->assertEquals('Negative not allowed : -1,-4', $result);
    }



}