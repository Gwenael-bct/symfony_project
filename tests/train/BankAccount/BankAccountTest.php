<?php

namespace App\Tests\train\BankAccount;

use App\traintest\BankAccount\BankAccount;
use Exception;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BankAccountTest extends WebTestCase
{
    /**
     * @dataProvider differentamount
     */
    public function testdepote($expect, $amount)
    {
        $bank = new BankAccount();
        $this->assertSame($amount, $bank->deposit($expect));

    }

    /**
     * @dataProvider depot
     */
    public function testdepotmontant($expect, $amount)
    {
        $bank = new BankAccount();
        $bank->balance += 1000;
        $bank->deposit($expect);
        $this->assertSame($amount, $bank->getBalance());
    }


    /**
     * @dataProvider retrait
     */
    public function testretrait($expect, $amount)
    {
        $bank = new BankAccount();
        $bank->balance += 10000;
        $bank->withdraw($expect);
        $this->assertSame($amount, $bank->getBalance());
    }


    public function differentamount()
    {
        return [
            [1000, null],
            [500, null]
        ];
    }
    public function depot()
    {
        return [
            [1000, 2000],
            [500, 1500],
            [0, "InvalidArgumentException Amount must be positive"]
        ];
    }

    public function retrait()
    {
        return [
            [0, 10000],
            [500, 9500],
            [1000000, Exception::class],
        ];
    }
}