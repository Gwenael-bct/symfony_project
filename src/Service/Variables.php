<?php

namespace App\Service;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Variables
{
    private $prenom;

    public function __construct(string $prenom)
    {
        $this->prenom = $prenom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }
}