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

}