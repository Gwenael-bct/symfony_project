<?php

namespace App\Tests\train;

use App\traintest\Authentification\AuthService;
use App\traintest\Authentification\UserRepository;
use App\traintest\Authentification\User;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    private $userRepository;
    private $authService;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository();
        $this->authService = new AuthService($this->userRepository);
    }

    public function testLoginSuccess()
    {
        $user = new User('john_doe', 'securepassword');
        $this->userRepository->addUser($user);

        $result = $this->authService->login('john_doe', 'securepassword');

        $this->assertTrue($result);
    }

    public function testLoginUserNotFound()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Utilisateur non trouvé.');

        $this->authService->login('non_existing_user', 'password');
    }

    public function testLoginIncorrectPassword()
    {
        $user = new User('john_doe', 'securepassword');
        $this->userRepository->addUser($user);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Mot de passe incorrect.');

        $this->authService->login('john_doe', 'wrongpassword');
    }
}
