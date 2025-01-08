<?php

use App\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculator();
    }

    public function testAdd()
    {
        // Basic cases
        $this->assertEquals(5, $this->calculator->add(2, 3));
        $this->assertEquals(0, $this->calculator->add(-2, 2));
        $this->assertEquals(-5, $this->calculator->add(-2, -3));

        // Floating point cases
        $this->assertEquals(5.5, $this->calculator->add(2.2, 3.3), '', 0.0001);
        $this->assertEquals(0.0, $this->calculator->add(-2.5, 2.5), '', 0.0001);

        // Large numbers
        $this->assertEquals(PHP_INT_MAX, $this->calculator->add(PHP_INT_MAX, 0));
    }

    public function testSubtract()
    {
        // Basic cases
        $this->assertEquals(1, $this->calculator->subtract(3, 2));
        $this->assertEquals(-4, $this->calculator->subtract(-2, 2));
        $this->assertEquals(1, $this->calculator->subtract(-2, -3));

        // Floating point cases
        $this->assertEquals(0.5, $this->calculator->subtract(3.3, 2.8), '', 0.0001);
        $this->assertEquals(-5.5, $this->calculator->subtract(-2.2, 3.3), '', 0.0001);
    }

    public function testMultiply()
    {
        // Basic cases
        $this->assertEquals(6, $this->calculator->multiply(2, 3));
        $this->assertEquals(-4, $this->calculator->multiply(-2, 2));
        $this->assertEquals(6, $this->calculator->multiply(-2, -3));
        $this->assertEquals(0, $this->calculator->multiply(0, 5));
    }

    public function testDivide()
    {
        // Basic cases
        $this->assertEquals(2, $this->calculator->divide(6, 3));
        $this->assertEquals(-1, $this->calculator->divide(-2, 2));
        $this->assertEquals(1.5, $this->calculator->divide(-3, -2), '', 0.0001);
    }
}
