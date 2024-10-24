<?php

namespace App\traintest;

class Statistiques
{
    public function moyenne(array $nombres): float
    {
        // Vérifier si le tableau est vide
        if (count($nombres) <= 1) {
            throw new InvalidArgumentException("Le tableau ne peut pas être vide.");
        }

        return array_sum($nombres) / count($nombres);
    }
}
