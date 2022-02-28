<?php

declare(strict_types=1);
namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;

final class StringCalculatorTest extends TestCase
{
    private $stringCalculator;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->stringCalculator = new StringCalculator();

    }

    /**
     * @test
     */
    public function emptyStringReturnsZero(){


        $result = $this->stringCalculator->add("");

        $this->assertEquals("0", $result);
    }

    /**
     * @test
     */
    public function stringOneReturnsOne(){

        $result = $this->stringCalculator->add("1");

        $this->assertEquals("1", $result);
    }

    /**
     * @test
     */
    public function stringNumbersReturnsAdd(){

        $result = $this->stringCalculator->add("0,1,2,4");

        $this->assertEquals("7", $result);
    }

    /**
     * @test
     */
    public function stringNumbersReturnsAddWithNewLineSeparator(){

        $result = $this->stringCalculator->add('0\n1,2,4');

        $this->assertEquals("7", $result);
    }

    /**
     * @test
     */
    public function stringNumbersWithInvalidSeparators(){

        $result = $this->stringCalculator->add('0,2,\n4');
        $delimiter = '\n';

        $this->assertEquals("Number expected but '$delimiter' found at position 4", $result);
    }

    /**
     * @test
     */
    public function missingNumberInLastPosition(){

        $result = $this->stringCalculator->add('0,2,4,');

        $this->assertEquals("Number expected but NOT found",$result);
    }

    /**
     * @test
     */
    public function stringNumbersReturnsAddWithCustomSeparator(){

        $result = $this->stringCalculator->add('//;\n1;2;4');

        $this->assertEquals("7", $result);
    }

    /**
     * @test
     */
    public function stringNumbersWithInvalidSeparatorsInCustomSeparator(){

        $result = $this->stringCalculator->add('//;\n1;2,4');

        $this->assertEquals("';' expected but ',' found at position 3", $result);
    }

    /**
     * @test
     */
    public function stringNumbersWithNegativeNumbers(){

        $result = $this->stringCalculator->add("0,-1,2,-4");

        $this->assertEquals('Negative not allowed : -1,-4', $result);
    }

    /**
     * @test
     */
    public function stringNumbersWithMultipleErrors(){

        $result = $this->stringCalculator->add('-1,,2');

        $this->assertEquals("Number expected but ',' found at position 3\nNegative not allowed : -1", $result);
    }

    /**
     * @test
     */
    public function stringNumbersReturnsMultiply(){

        $result = $this->stringCalculator->multiply("1,2,4");

        $this->assertEquals("8", $result);
    }




}