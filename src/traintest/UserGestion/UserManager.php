<?php

namespace App\traintest\UserGestion;

class UserManager {
    private $users = [];

    public function addUser(User $user) {
        $this->users[] = $user;
    }

    public function getUsernames() {
        return array_map(function($user) {
            return $user->getUsername();
        }, $this->users);
    }
}