<?php

namespace App\Tests\train\Temperature;

use App\traintest\Température\Temperature;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TemperatureTest extends WebTestCase
{
    /**
     * @dataProvider temp
     */
    public function testcalcules($degre, $method, $attendu)
    {
        $temp = new Temperature($degre);
        $this->assertSame($attendu, $temp->$method());
    }


    public function temp()
    {
        return [
            [40, 'toKelvin',  313.15],
            [40, 'toFahrenheit', 104],
            [25, 'toFahrenheit', 77]
        ];
    }


}