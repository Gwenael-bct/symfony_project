<?php

namespace App\Tests\train;
use App\traintest\Statistiques;
use PHPUnit\Framework\TestCase;

class StatistiquesTest extends TestCase
{
    /**
     * @dataProvider moyenneProvider
     */
    public function testmoyenne($moyenne, $expectedmoyenne)
    {
        $moyenne = new Statistiques($moyenne);
        $this->assertEquals($expectedmoyenne, $moyenne->moyenne());
    }
    public function moyenneProvider()
    {
        return [
            [[], 0],
            [[10], 0],
            [[2, 2], 2],
            [[2,3], 2.5],
            [[10,20], 15],
        ];
    }
}