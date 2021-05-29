<?php

namespace Marien\ArbitraryPrecisionCalculator\Calculator;

use Marien\ArbitraryPrecisionCalculator\Exceptions\DevideByZeroException;
use Marien\ArbitraryPrecisionCalculator\Exceptions\WrongFormatException;
use Marien\ArbitraryPrecisionCalculator\Exceptions\WrongTypeException;

class Calculator
{
    private int $scale;

    public function __construct(int $scale = 8)
    {
        $this->scale = $scale;
    }

    /**
     * @param string|float|int $num1
     * @param string|float|int $num2
     * @return string
     * @throws WrongFormatException
     * @throws WrongTypeException
     */
    public function add($num1, $num2): string
    {
        return bcadd($this->formatInput($num1), $this->formatInput($num2), $this->scale);
    }

    /**
     * @param string|float|int $num1
     * @param string|float|int $num2
     * @return string
     * @throws WrongFormatException
     * @throws WrongTypeException
     */
    public function subtract($num1, $num2): string
    {
        return bcsub($this->formatInput($num1), $this->formatInput($num2), $this->scale);
    }

    /**
     * @param $num1
     * @param $num2
     * @return string
     * @throws DevideByZeroException
     * @throws WrongFormatException
     * @throws WrongTypeException
     */
    public function divide($num1, $num2): string
    {
        $num2String = $this->formatInput($num2);

        if(intval($num2String) === 0) {
            throw new DevideByZeroException('num2 input is zero. Divides by zero are not possible');
        }

        return bcdiv($this->formatInput($num1), $num2String, $this->scale);
    }

    /**
     * @param string|float|int $num1
     * @param string|float|int $num2
     * @return string
     * @throws WrongFormatException
     * @throws WrongTypeException
     */
    public function multiply($num1, $num2): string
    {
        return bcmul($this->formatInput($num1), $this->formatInput($num2), $this->scale);
    }

    /**
     * @param $input
     * @return string
     * @throws WrongFormatException
     * @throws WrongTypeException
     */
    private function formatInput($input): string
    {
        if (is_float($input) || is_int($input)) {
            return strval($input);
        }

        if (!is_string($input)) {
            $type = gettype($input);
            throw new WrongTypeException("input must be of type 'float', 'int' or 'string' {$type} given");
        }

        // Regex used instead of is_numeric. is_numeric allows scientific notation. bcmath does not
        if (!preg_match("/^(-)?[0-9]+(\.[0-9]+)?$/", $input)) {
            throw new WrongFormatException('the string input should be numeric');
        }

        return $input;
    }
}