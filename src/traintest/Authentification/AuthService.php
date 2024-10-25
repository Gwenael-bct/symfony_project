<?php

namespace App\traintest\Authentification;


class AuthService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(string $username, string $password): bool
    {
        $user = $this->userRepository->findUserByUsername($username);

        if (!$user) {
            throw new \Exception("Utilisateur non trouvé.");
        }

        if (!password_verify($password, $user->getPassword())) {
            throw new \Exception("Mot de passe incorrect.");
        }

        // Simuler une connexion réussie
        return true;
    }

    public function logout(): string
    {
        // Logique pour déconnexion (si nécessaire)
        return 'déconnecté';
    }
}
