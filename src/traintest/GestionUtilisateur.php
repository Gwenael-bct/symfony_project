<?php

namespace App\traintest;
use App\traintest\User;
class GestionUtilisateur {
    private $utilisateur;

    public function __construct(User $utilisateur) {
        $this->utilisateur = $utilisateur;
    }

    public function afficherNom() {
        return $this->utilisateur->getNom();
    }
}