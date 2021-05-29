<?php

use Marien\ArbitraryPrecisionCalculator\Calculator\Calculator;
use Marien\ArbitraryPrecisionCalculator\Exceptions\DevideByZeroException;
use Marien\ArbitraryPrecisionCalculator\Exceptions\WrongFormatException;
use Marien\ArbitraryPrecisionCalculator\Exceptions\WrongTypeException;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private Calculator $calculator;

    public function setUp(): void
    {
        $this->calculator = new Calculator(4);
    }

    /**
     * @throws WrongFormatException
     * @throws WrongTypeException
     */
    public function testAdd(): void
    {
        $num1 = '5.2234';
        $num2 = '2.1113';
        $expectedResult = '7.3347';

        $result = $this->calculator->add($num1, $num2);

        self::assertSame($expectedResult, $result);
    }

    /**
     * @throws WrongFormatException
     * @throws WrongTypeException
     */
    public function testAddWithIntAndFloat(): void
    {
        $num1 = 5;
        $num2 = 3.444323;
        $expectedResult = '8.4443';

        $result = $this->calculator->add($num1, $num2);

        self::assertSame($expectedResult, $result);
    }

    /**
     * @throws WrongFormatException
     * @throws WrongTypeException
     */
    public function testAddWithIntAndString(): void
    {
        $num1 = 5;
        $num2 = '3.444323';
        $expectedResult = '8.4443';

        $result = $this->calculator->add($num1, $num2);

        self::assertSame($expectedResult, $result);
    }

    /**
     * @throws WrongFormatException
     * @throws WrongTypeException
     */
    public function testAddWithNegative(): void
    {
        $num1 = 1;
        $num2 = '-3.2234';
        $expectedResult = '-2.2239';

        $result = $this->calculator->add($num1, $num2);

        self::assertSame($expectedResult, $result);
    }

    /**
     * @throws WrongFormatException
     * @throws WrongTypeException
     */
    public function testAddWithInvalidString(): void
    {
        $num1 = 5;
        $num2 = 'invalid';

        self::expectException(WrongFormatException::class);

        $this->calculator->add($num1, $num2);
    }

    /**
     * @throws WrongFormatException
     * @throws WrongTypeException
     */
    public function testSubtract(): void
    {
        $num1 = '5.2234';
        $num2 = '2.1113';
        $expectedResult = '3.1121';

        $result = $this->calculator->subtract($num1, $num2);

        self::assertSame($expectedResult, $result);
    }

    /**
     * @throws WrongFormatException
     * @throws WrongTypeException
     * @throws DevideByZeroException
     */
    public function testDivide(): void
    {
        $num1 = '5.2234';
        $num2 = '2.1113';
        $expectedResult = '2.4740';

        $result = $this->calculator->divide($num1, $num2);

        self::assertSame($expectedResult, $result);
    }

    /**
     * @throws DevideByZeroException
     * @throws WrongFormatException
     * @throws WrongTypeException
     */
    public function testDivideByZero(): void
    {
        $num1 = '5';
        $num2 = '0';

        self::expectException(DevideByZeroException::class);

        $this->calculator->divide($num1, $num2);
    }

    /**
     * @throws WrongFormatException
     * @throws WrongTypeException
     */
    public function testMultiply(): void
    {
        $num1 = '5.2234';
        $num2 = '2.1113';
        $expectedResult = '11.0281';

        $result = $this->calculator->multiply($num1, $num2);

        self::assertSame($expectedResult, $result);
    }
}