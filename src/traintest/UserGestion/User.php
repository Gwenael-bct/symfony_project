<?php

namespace App\traintest\UserGestion;

class User {
    private $username;

    public function __construct($username) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }
}