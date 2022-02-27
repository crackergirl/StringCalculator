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

        $stringCalculator = new StringCalculator("");
        $result = $stringCalculator->add();
        $this->assertEquals("0", $result);
    }

    /**
     * @test
     */
    public function stringOneReturnsOneinAdd(){

        $stringCalculator = new StringCalculator("1");
        $result = $stringCalculator->add();
        $this->assertEquals("1", $result);
    }

    /**
     * @test
     */
    public function stringNumbersReturnsAdd(){

        $stringCalculator = new StringCalculator("0,1,2,4");
        $result = $stringCalculator->add();
        $this->assertEquals("7", $result);
    }
    /**
     * @test
     */
    public function stringNumbersReturnsAddWithNewLineSeparator(){

        $stringCalculator = new StringCalculator('0\n1,2,4');
        $result = $stringCalculator->add();
        $this->assertEquals("7", $result);
    }
    /**
     * @test
     */
    public function stringNumbersWithInvalidSeparatorsinAdd(){

        $stringCalculator = new StringCalculator('0,2,\n4');
        $result = $stringCalculator->add();
        $delimiter = '\n';
        $this->assertEquals("Number expected but '$delimiter' found at position 4", $result);
    }

    /**
     * @test
     */
    public function missingNumberInLastPositioninAdd(){

        $stringCalculator = new StringCalculator('0,2,4,');
        $result = $stringCalculator->add();
        $this->assertEquals("Number expected but NOT found",$result);
    }

    /**
     * @test
     */
    public function stringNumbersReturnsAddWithCustomSeparator(){

        $stringCalculator = new StringCalculator('//;\n1;2;4');
        $result = $stringCalculator->add();
        $this->assertEquals("7", $result);
    }

    /**
     * @test
     */
    public function stringNumbersWithInvalidSeparatorsInCustomSeparatorinAdd(){

        $stringCalculator = new StringCalculator('//;\n1;2,4');
        $result = $stringCalculator->add();
        $this->assertEquals("';' expected but ',' found at position 3", $result);
    }
    /**
     * @test
     */
    public function stringNumbersWithNegativeNumbersinAdd(){

        $stringCalculator = new StringCalculator("0,-1,2,-4");
        $result = $stringCalculator->add();
        $this->assertEquals('Negative not allowed : -1,-4', $result);
    }

    /**
     * @test
     */
    public function stringNumbersWithMultipleErrorsinAdd(){

        $stringCalculator = new StringCalculator('-1,,2');
        $result = $stringCalculator->add();
        $this->assertEquals("Number expected but ',' found at position 3\nNegative not allowed : -1", $result);
    }

    /**
     * @test
     */
    public function emptyStringReturnsIntZeroinAdd(){

        $stringCalculator = new StringCalculator("");
        $result = $stringCalculator->addReturnsIntNumber();
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function stringNumbersWithMultipleErrorsInAddReturnsIntNumber(){

        $stringCalculator = new StringCalculator('-1,,2');
        $result = $stringCalculator->addReturnsIntNumber();
        $this->assertEquals("Number expected but ',' found at position 3\nNegative not allowed : -1", $result);
    }
    /**
     * @test
     */
    public function stringOneReturnsOneinMultiply(){

        $stringCalculator = new StringCalculator("1");
        $result = $stringCalculator->multiply();
        $this->assertEquals("1", $result);
    }
    /**
     * @test
     */
    public function stringNumbersReturnsMultiply(){

        $stringCalculator = new StringCalculator("1,2,4");
        $result = $stringCalculator->multiply();
        $this->assertEquals("8", $result);
    }
    /**
     * @test
     */
    public function stringNumbersReturnsMultiplyWithNewLineSeparator(){

        $stringCalculator = new StringCalculator('1\n2,4');
        $result = $stringCalculator->multiply();
        $this->assertEquals("8", $result);
    }
    /**
     * @test
     */
    public function stringNumbersWithInvalidSeparatorsinMultiply(){

        $stringCalculator = new StringCalculator('0,2,\n4');
        $result = $stringCalculator->multiply();
        $delimiter = '\n';
        $this->assertEquals("Number expected but '$delimiter' found at position 4", $result);
    }
    /**
     * @test
     */
    public function missingNumberInLastPositioninMultiply(){

        $stringCalculator = new StringCalculator('0,2,4,');
        $result = $stringCalculator->multiply();
        $this->assertEquals("Number expected but NOT found",$result);
    }



}