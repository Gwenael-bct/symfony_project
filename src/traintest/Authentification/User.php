<?php

namespace App\traintest\Authentification;


class User
{
    private $username;
    private $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_BCRYPT); // Hashing for security
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
