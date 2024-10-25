<?php

namespace App\traintest\BankAccount;

use InvalidArgumentException;

class BankAccount {
    public $balance = 0;

    public function deposit($amount) {
        if ($amount <= 0) {
            throw new InvalidArgumentException("Amount must be positive");
        }
        $this->balance += $amount;
    }

    public function withdraw($amount) {
        if ($amount > $this->balance) {
            throw new InvalidArgumentException("Insufficient funds");
        }
        $this->balance -= $amount;
    }

    public function getBalance() {
        return $this->balance;
    }
}
