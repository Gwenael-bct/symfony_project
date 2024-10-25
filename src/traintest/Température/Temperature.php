<?php

namespace App\traintest\Température;

class Temperature {
    private $celsius;

    public function __construct($celsius) {
        $this->celsius = $celsius;
    }

    public function toFahrenheit() {
        return $this->celsius * 9/5 + 32;
    }

    public function toKelvin() {
        return $this->celsius + 273.15;
    }
}