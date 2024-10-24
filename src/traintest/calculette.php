<?php

namespace App\traintest;

use DivisionByZeroError;

class calculette
{
    public function somme($a, $b): float
    {
        return $a + $b;
    }
    public function division($a, $b): float
    {
        if ($b === 0) {
            throw new DivisionByZeroError("Division par zéro.");
        }
        return $a / $b;
    }
}