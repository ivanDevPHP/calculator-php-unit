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
        $this->assertSame(5, $this->calculator->add(2, 3));
        $this->assertSame(0, $this->calculator->add(-2, 2));
        $this->assertSame(-5, $this->calculator->add(-2, -3));

        // Floating point cases
        $this->assertTrue(abs($this->calculator->add(2.2, 3.3) - 5.5) < 0.0001);
        $this->assertTrue(abs($this->calculator->add(-2.5, 2.5) - 0.0) < 0.0001);

        // Large numbers
        $this->assertSame(PHP_INT_MAX, $this->calculator->add(PHP_INT_MAX, 0));

        // Edge cases
        $this->assertSame(0, $this->calculator->add(0, 0)); // Adding zero to zero
        $this->assertSame(0, $this->calculator->add(-0, 0)); // Ensure handling of signed zero
    }

    public function testSubtract()
    {
        // Basic cases
        $this->assertSame(1, $this->calculator->subtract(3, 2));
        $this->assertSame(-4, $this->calculator->subtract(-2, 2));
        $this->assertSame(1, $this->calculator->subtract(-2, -3));

        // Floating point cases
        $this->assertTrue(abs($this->calculator->subtract(3.3, 2.8) - 0.5) < 0.0001);
        $this->assertTrue(abs($this->calculator->subtract(-2.2, 3.3) - -5.5) < 0.0001);

        // Edge cases
        $this->assertSame(0, $this->calculator->subtract(0, 0)); // Subtracting zero from zero
        $this->assertSame(-PHP_INT_MAX, $this->calculator->subtract(0, PHP_INT_MAX)); // Subtracting a large number
    }

    public function testMultiply()
    {
        // Basic cases
        $this->assertSame(6, $this->calculator->multiply(2, 3));
        $this->assertSame(-4, $this->calculator->multiply(-2, 2));
        $this->assertSame(6, $this->calculator->multiply(-2, -3));
        $this->assertSame(0, $this->calculator->multiply(0, 5));

        // Edge cases
        $this->assertSame(0, $this->calculator->multiply(0, 0)); // Zero times zero
        $this->assertSame(PHP_INT_MAX, $this->calculator->multiply(PHP_INT_MAX, 1)); // Multiplying a large number
        $this->assertSame(-PHP_INT_MAX, $this->calculator->multiply(PHP_INT_MAX, -1)); // Negative multiplication
    }

    public function testDivide()
    {
        // Basic cases
        $this->assertSame(2, $this->calculator->divide(6, 3));
        $this->assertSame(-1, $this->calculator->divide(-2, 2));
        $this->assertTrue(abs($this->calculator->divide(-3, -2) - 1.5) < 0.0001);

        // Edge cases
        $this->expectException(DivisionByZeroError::class);
        $this->calculator->divide(5, 0); // Division by zero should throw an exception

        // Dividing by 1 or -1
        $this->assertSame(PHP_INT_MAX, $this->calculator->divide(PHP_INT_MAX, 1));
        $this->assertSame(-PHP_INT_MAX, $this->calculator->divide(PHP_INT_MAX, -1));

        // Floating point division
        $this->assertTrue(abs($this->calculator->divide(1, 3) - 0.3333) < 0.0001);
    }
}
