<?php

namespace App\Tests\train;

use App\traintest\Calculator\Calculator;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorTest extends WebTestCase
{
    /**
     * @dataProvider calcul
     */
    public function testcalcules($a, $b, $value, $method)
    {
        $addition = new Calculator();
        //echo $method . 'arguments a:' . $a . ', arguments b:' . $b . PHP_EOL;
        $this->assertSame($value, $addition->$method($a, $b));
    }

    /**
     * @dataProvider divisionExceptionProvider
     */
    public function testDividesThrowsExceptionOnDivisionByZero($a)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Division by zero");

        $calculator = new Calculator();
        $calculator->divide($a, 0);
    }
    public function calcul()
    {
        return [
            [5, 6, 11, 'add'],
            [0, 1, 1, 'add'],
            [-5, 4, -1, 'add'],
            [5, 6, -1, 'subtract'],
            [-1, -1, 0, 'subtract'],
            [-1, 1, -2, 'subtract'],
            [20, 10, 10, 'subtract'],
            [0, 6, 0, 'multiply'],
            [10, -10, -100, 'multiply'],
            [5, 5, 25, 'multiply'],
            [0, 6, 0, 'divide'],
            [5, 2, 2.5, 'divide'],
            [-5, -2, 2.5, 'divide']
        ];
    }
    public function divisionExceptionProvider()
    {
        return [
            [6],
            [10],
            [4]
        ];
    }
}