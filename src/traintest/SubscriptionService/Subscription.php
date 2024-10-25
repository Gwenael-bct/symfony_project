<?php

namespace App\traintest\SubscriptionService;

class Subscription {
    public $endDate;

    public function __construct($endDate) {
        $this->endDate = $endDate;
    }
}