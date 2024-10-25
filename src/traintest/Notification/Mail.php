<?php

namespace App\traintest\Notification;

class Mail
{
    public function send($email, $message)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
}