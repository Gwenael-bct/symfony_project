<?php

namespace App\traintest\SubscriptionService;
use App\traintest\SubscriptionService\Subscription;

class SubscriptionService {
    public function isActive(Subscription $subscription) {
        return $subscription->endDate > new \DateTime();
    }
}