<?php

namespace App\Tests\train\Notification;

use App\traintest\Notification\NotificationService;
use Nette\Mail\Mailer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Notifier\Notification\Notification;

namespace App\Tests\Service;

use App\traintest\Notification\Mail;
use App\traintest\Notification\NotificationService;
use App\traintest\Notification\SmsService;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{
    public function testNotifyBySMS()
    {
        // Créer un mock pour smsService
        $mockSmsService = $this->createMock(SmsService::class);

        // Configurer le mock pour s'assurer que send est appelé avec les bons arguments
        $mockSmsService->expects($this->once())
            ->method('send')
            ->with('1234567890', 'Hello, this is a test message!')
            ->willReturn(true);

        // Créer une instance de NotificationService avec le mock
        $notificationService = new NotificationService(null, $mockSmsService);

        // Appeler la méthode notifyBySMS
        $result = $notificationService->notifyBySMS('1234567890', 'Hello, this is a test message!');

        // Vérifier que le résultat est bien vrai
        $this->assertTrue($result);
    }

    public function testNotifyByMail()
    {
        // Créer un mock pour smsService
        $mockSmsService = $this->createMock(Mail::class);

        // Configurer le mock pour s'assurer que send est appelé avec les bons arguments
        $mockSmsService->expects($this->once())
            ->method('send')
            ->with('1234567890', 'Hello, this is a test message!')
            ->willReturn(false);

        // Créer une instance de NotificationService avec le mock
        $notificationService = new NotificationService($mockSmsService, null);

        // Appeler la méthode notifyBySMS
        $result = $notificationService->notifyByEmail('1234567890', 'Hello, this is a test message!');

        // Vérifier que le résultat est bien vrai
        $this->assertTrue($result);
    }
}
