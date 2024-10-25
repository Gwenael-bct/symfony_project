<?php

namespace App\traintest\OrderService;
use App\traintest\OrderService\InventoryService;
use App\traintest\OrderService\PaymentService;

class OrderService {
    private $inventoryService;
    private $paymentService;

    public function __construct(InventoryService $inventoryService, PaymentService $paymentService) {
        $this->inventoryService = $inventoryService;
        $this->paymentService = $paymentService;
    }

    public function placeOrder($orderData) {
        // Vérifie le stock de l'article
        if (!$this->inventoryService->checkStock($orderData['itemId'])) {
            throw new \Exception('Article non disponible en stock.');
        }

        // Traite le paiement
        if (!$this->paymentService->process($orderData['amount'])) {
            throw new \Exception('Échec du traitement du paiement.');
        }

        // Logique pour finaliser la commande (simulée ici)
        return 'Commande passée avec succès.';
    }
}
