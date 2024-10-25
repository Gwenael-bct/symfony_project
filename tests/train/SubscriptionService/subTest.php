<?php

namespace App\Tests\train\SubscriptionService;

use App\traintest\SubscriptionService\Subscription;
use App\traintest\SubscriptionService\SubscriptionService;
use DateInterval;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class subTest extends WebTestCase
{

 /**
 * @dataProvider differentdate
 */
    public function testOrderSuccess($date, $retour)
    {
        // Crée une instance de OrderService avec le mock
        $orderService = new SubscriptionService();
        $this->assertSame($retour, $orderService->isActive($date));

    }

    public function differentdate()
    {
        $Datetime = new Datetime('NOW');
        $Datetime2 = new Datetime('NOW');
        $Datetime3 = new Datetime('NOW');
        return [
            [new Subscription($Datetime->add(DateInterval::createFromDateString('2 day'))), true],
            [new Subscription($Datetime2->add(DateInterval::createFromDateString('- 2 day'))), false],
            [new Subscription($Datetime3->add(DateInterval::createFromDateString('- 2 day'))), false]
        ];
    }
}