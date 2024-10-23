<?php

// tests/Controller/ProfileControllerTest.php
namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileControllerTest extends WebTestCase
{
    // ...

    public function testVisitingWhileLoggedIn(): void
    {
        $client = static::createClient([], [
            'HTTP_HOST' => 'http://127.0.0.1',
            'HTTP_PORT' => '45689', // Assurez-vous que c'est le bon port
        ]);        $userRepository = static::getContainer()->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('gwenael@gmail.com');

        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // test e.g. the profile page
        $client->request('GET', '/Movie');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello John!');
    }
}