<?php

namespace App\traintest\OrderService;

class InventoryService {
    private $stock = [
        'item1' => 10,
        'item2' => 0, // Pas en stock
        'item3' => 5,
    ];

    public function checkStock($itemId) {
        // Vérifie si l'article est en stock
        if (isset($this->stock[$itemId]) && $this->stock[$itemId] > 0) {
            return true; // Article en stock
        }
        return false; // Article non disponible
    }
}