# arbitrary-precision-calculator
This package adds a layer around the PHP bcmath functions add, subtract, multiply, divide, modulo and raise to the power. This makes it possible to not only use string but also use int and floats as input.

How to use
````
use Marien\ArbitraryPrecisionCalculator\Calculator\Calculator;

// Scale can be set when initializing the Calculator object
$calculator = new Calculator(8);

$calculator->add(5, '222.33334');
$calculator->subtract('100', '50.322333');
$calculator->divide(1000.333, 20);
$calculator->multiply('100', '50.322333');
$calculator->raiseToPower('3.334', '2');
$calculator->modulo('3.334', '2');
````

### Exceptions
This package uses it's own exceptions:
````
// Wrong format of input String
Marien\ArbitraryPrecisionCalculator\Exceptions\WrongFormatException

// Unsupported type used as input (not 'string', 'float' or 'int')
Marien\ArbitraryPrecisionCalculator\Exceptions\WrongTypeException

// Devide by zero
Marien\ArbitraryPrecisionCalculator\Exceptions\DevideByZeroException
````

### Run tests
````
vendor\bin\phpunit tests
````