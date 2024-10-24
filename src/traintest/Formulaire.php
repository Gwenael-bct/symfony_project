<?php

namespace App\traintest;

use App\Security\EmailVerifier;

class Formulaire
{
    private $email;
    public function __construct($email)
    {
        $this->email = $email;
    }
    public function validation()
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
    }
}
