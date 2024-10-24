<?php
use PHPUnit\Framework\TestCase;
use DivisionByZeroError;
use App\traintest\calculette;
class calculetteTest extends TestCase
{
    public function testSomme()
    {
        $calculette = new calculette();
        $this->assertEquals(4, $calculette->somme(2, 2));
    }

    public function testDivision()
    {
        $this->expectException(DivisionByZeroError::class);
        $calculette = new calculette();
        $calculette->division(2, 0);
    }
}