<?php

namespace App\Tests\train;

use App\traintest\EventManager;
use PHPUnit\Framework\TestCase;

class EventManagerTest extends TestCase
{
    public function testRegisterCallback()
    {
        $eventManager = new EventManager();
        $callbackCalled = false;

        // Enregistre un callback
        $eventManager->registerCallback('testEvent', function() use (&$callbackCalled) {
            $callbackCalled = true;
        });

        // Vérifie que le callback a été enregistré
        $this->assertCount(1, $eventManager->callbacks['testEvent']);
        $this->assertFalse($callbackCalled);

        // Déclenche l'événement
        $eventManager->triggerEvent('testEvent', null);

        // Vérifie que le callback a été appelé
        $this->assertTrue($callbackCalled);
    }
}
