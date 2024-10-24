<?php

use App\traintest\User;
use PHPUnit\Framework\TestCase;
use App\traintest\GestionUtilisateur;
// Classe de test GestionUtilisateurTest
class GestionUtilisateurTest extends TestCase {
    public function testAfficherNom() {
        // Crée un mock de Utilisateur
        $mockUtilisateur = $this->createMock(User::class);

        // Configure le mock pour que getNom retourne "Alice"
        $mockUtilisateur->method('getNom')->willReturn('Alice');

        // Crée une instance de GestionUtilisateur avec le mock
        $gestionUtilisateur = new GestionUtilisateur($mockUtilisateur);

        // Vérifie que afficherNom() retourne "Alice"
        $this->assertEquals('Alice', $gestionUtilisateur->afficherNom());
    }
}