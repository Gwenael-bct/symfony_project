<?php

namespace App\traintest\Notification;

class NotificationService {
    private $mailer;
    private $smsService;

    public function __construct($mailer, $smsService) {
        $this->mailer = $mailer;
        $this->smsService = $smsService;
    }

    public function notifyByEmail($email, $message) {
        return $this->mailer->send($email, $message);
    }

    public function notifyBySMS($phone, $message) {
        return $this->smsService->send($phone, $message);
    }
}