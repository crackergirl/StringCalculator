<?php

declare(strict_types=1);
namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;

final class StringCalculatorTest extends TestCase
{

    /**
     * @test
     */
    public function emptyStringReturnsZeroinAdd(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add("");
        $this->assertEquals("0", $result);
    }

    /**
     * @test
     */
    public function stringOneReturnsOneinAdd(){

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
    public function stringNumbersWithInvalidSeparatorsinAdd(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add('0,2,\n4');
        $delimiter = '\n';
        $this->assertEquals("Number expected but '$delimiter' found at position 4", $result);
    }

    /**
     * @test
     */
    public function missingNumberInLastPositioninAdd(){

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
    public function stringNumbersWithInvalidSeparatorsInCustomSeparatorinAdd(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add('//;\n1;2,4');
        $this->assertEquals("';' expected but ',' found at position 3", $result);
    }
    /**
     * @test
     */
    public function stringNumbersWithNegativeNumbersinAdd(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add("0,-1,2,-4");
        $this->assertEquals('Negative not allowed : -1,-4', $result);
    }

    /**
     * @test
     */
    public function stringNumbersWithMultipleErrorsinAdd(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->add('-1,,2');
        $this->assertEquals("Number expected but ',' found at position 3\nNegative not allowed : -1", $result);
    }

    /**
     * @test
     */
    public function stringOneReturnsOneinMultiply(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->multiply("1");
        $this->assertEquals("1", $result);
    }
    /**
     * @test
     */
    public function stringNumbersReturnsMultiply(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->multiply("1,2,4");
        $this->assertEquals("8", $result);
    }
    /**
     * @test
     */
    public function stringNumbersReturnsMultiplyWithNewLineSeparator(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->multiply('1\n2,4');
        $this->assertEquals("8", $result);
    }
    /**
     * @test
     */
    public function stringNumbersWithInvalidSeparatorsinMultiply(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->multiply('0,2,\n4');
        $delimiter = '\n';
        $this->assertEquals("Number expected but '$delimiter' found at position 4", $result);
    }
    /**
     * @test
     */
    public function missingNumberInLastPositioninMultiply(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->multiply('0,2,4,');
        $this->assertEquals("Number expected but NOT found",$result);
    }
    /**
     * @test
     */
    public function stringNumbersReturnsMultiplyWithCustomSeparator(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->multiply('//;\n1;2;4');
        $this->assertEquals("8", $result);
    }
    /**
     * @test
     */
    public function stringNumbersWithInvalidSeparatorsInCustomSeparatorinMultiply(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->multiply('//;\n1;2,4');
        $this->assertEquals("';' expected but ',' found at position 3", $result);
    }
    /**
     * @test
     */
    public function stringNumbersWithNegativeNumbersinMultiply(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->multiply("0,-1,2,-4");
        $this->assertEquals('Negative not allowed : -1,-4', $result);
    }
    /**
     * @test
     */
    public function stringNumbersWithMultipleErrorsinMultiply(){

        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->multiply('-1,,2');
        $this->assertEquals("Number expected but ',' found at position 3\nNegative not allowed : -1", $result);
    }



}