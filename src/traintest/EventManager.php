<?php

namespace App\traintest;

class EventManager {
    public $callbacks = [];

    public function registerCallback($eventName, callable $callback) {
        $this->callbacks[$eventName][] = $callback;
    }

    public function triggerEvent($eventName, $data) {
        if (isset($this->callbacks[$eventName])) {
            foreach ($this->callbacks[$eventName] as $callback) {
                $callback($data);
            }
        }
    }
}