<?php

namespace App\Tests\train\UserGestion;

use App\traintest\UserGestion\User;
use App\traintest\UserGestion\UserManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserGestionTest extends WebTestCase
{
    /**
     * @dataProvider listeuser
     */
    public function testget($users)
    {
        $usermanager = new UserManager();
        $resultat = [
            'tomy',
            'gwen',
            'cmoi'
        ];
        foreach ($users as $user) {
            $usermanager->addUser($user);
        }
        $this->assertEquals($resultat, $usermanager->getUsernames());
        $this->assertCount(count($users), $usermanager->getUsernames());
    }

    public function listeuser()
    {
        return [
            [[new User('tomy'), new User('gwen'), new User('cmoi')]]
        ];
    }
}