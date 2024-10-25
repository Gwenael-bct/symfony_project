<?php

namespace App\Tests\train\OrderService;

use App\traintest\OrderService\OrderService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\traintest\OrderService\InventoryService;
use App\traintest\OrderService\PaymentService;

class OrderServiceTest extends WebTestCase
{
    public function testOrderSuccess() {
        $mockInventory = $this->createMock(InventoryService::class);
        $mockInventory->method('checkStock')->willReturn(true);

        $mockPayment = $this->createMock(PaymentService::class);
        $mockPayment->method('process')->willReturn(true); // Correction ici

        // Crée une instance de OrderService avec le mock
        $orderService = new OrderService($mockInventory, $mockPayment);

        // Données de la commande
        $orderData = [
            'itemId' => 'item1',
            'amount' => 1000,
        ];

        // Vérifier que placeOrder ne lance pas d'exception et retourne le message de succès
        $result = $orderService->placeOrder($orderData);
        $this->assertEquals('Commande passée avec succès.', $result);
    }

    public function testOutOfStock() {
        $mockInventory = $this->createMock(InventoryService::class);
        $mockInventory->method('checkStock')->willReturn(false); // Doit retourner false

        $mockPayment = $this->createMock(PaymentService::class);
        $mockPayment->method('process')->willReturn(true); // Traitement du paiement réussi

        // Crée une instance de OrderService avec le mock
        $orderService = new OrderService($mockInventory, $mockPayment);

        // Données de la commande
        $orderData = [
            'itemId' => 'item1',
            'amount' => 1000,
        ];

        // Vérifier que placeOrder lance une exception pour l'article non disponible
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Article non disponible en stock.');

        $orderService->placeOrder($orderData);
    }
    public function testpaymentrefused() {
        $mockInventory = $this->createMock(InventoryService::class);
        $mockInventory->method('checkStock')->willReturn(true); // Doit retourner false

        $mockPayment = $this->createMock(PaymentService::class);
        $mockPayment->method('process')->willReturn(false); // Traitement du paiement réussi

        // Crée une instance de OrderService avec le mock
        $orderService = new OrderService($mockInventory, $mockPayment);

        // Données de la commande
        $orderData = [
            'itemId' => 'item1',
            'amount' => 1000,
        ];

        // Vérifier que placeOrder lance une exception pour l'article non disponible
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Échec du traitement du paiement.');

        $orderService->placeOrder($orderData);
    }
}
