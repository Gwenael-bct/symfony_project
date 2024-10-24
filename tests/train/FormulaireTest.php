<?php

namespace App\Tests\train;
use App\traintest\Formulaire;
use PHPUnit\Framework\TestCase;

class FormulaireTest extends TestCase
{
    /**
     * @dataProvider emailsProvider
     */
    public function testvalideemail($email, $expectedEmail)
    {
        $email = new Formulaire($email);
        $this->assertEquals($expectedEmail, $email->validation());
    }
    public function emailsProvider()
    {
        return [
            ['test@example.com', true],
            ['test@.com', false],
            ['test@com', false],
            ['', false]
        ];
    }
}