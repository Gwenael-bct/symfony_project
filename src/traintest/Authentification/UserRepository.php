<?php

namespace App\traintest\Authentification;


class UserRepository
{
    private $users = [];

    public function addUser(User $user): void
    {
        $this->users[$user->getUsername()] = $user;
    }

    public function findUserByUsername(string $username): ?User
    {
        return $this->users[$username] ?? null;
    }
}
