<?php
// src\DataFixtures\AppFixtures.php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $listeFirstname = ['Benjamin', 'Romain', 'Pauline', 'Hugo', 'Alex', 'Paul', 'Chloé', 'Alison', 'Martin', 'Gabriel', 'Alice', 'Maxime',
            'Alice', 'Adrien', 'Justine', 'David', 'Girard'];
        $listeLastname = ['Masson', 'Rousseau', 'Martin', 'Dupont', 'Vagnar', 'Moreau', 'Gauthier', 'Lepoutoux', 'Robert', 'Andre', 'Bertrand', 'Poulain',
            'Treil', 'Massa', 'Fontaine', 'Guerin', 'Richard'];
        $books = [
            ['title' => 'Les Mystères de Paris', 'description' => 'Une enquête captivante au cœur de la capitale.'],
            ['title' => 'Voyage au Centre de la Terre', 'description' => 'Une aventure scientifique incroyable.'],
            ['title' => '1984', 'description' => 'Une dystopie sur la surveillance et le contrôle.'],
            ['title' => 'Le Petit Prince', 'description' => 'Un conte poétique sur l\'amitié et la solitude.'],
            ['title' => 'L’Étranger', 'description' => 'Une réflexion sur l’absurdité de la vie.'],
            ['title' => 'À la recherche du temps perdu', 'description' => 'Une exploration des souvenirs et du temps.'],
            ['title' => 'Mémoires d’une jeune fille rangée', 'description' => 'Un regard sur la jeunesse et les aspirations.'],
            ['title' => 'Les Fleurs du mal', 'description' => 'Poèmes sur la beauté et la mélancolie.'],
            ['title' => 'L’Appel de la forêt', 'description' => 'L’histoire d’un chien en quête de liberté.'],
            ['title' => 'La Peste', 'description' => 'Une métaphore sur la condition humaine.'],
            ['title' => 'Germinal', 'description' => 'Un récit poignant sur la lutte des classes.'],
            ['title' => 'Les Trois Mousquetaires', 'description' => 'Aventures épiques d\'honneur et d\'amitié.'],
            ['title' => 'L’Assommoir', 'description' => 'Un tableau réaliste de la vie populaire à Paris.'],
            ['title' => 'Bel-Ami', 'description' => 'Ascension d\'un jeune homme dans le monde du journalisme.'],
            ['title' => 'Madame Bovary', 'description' => 'Une critique de l’ennui bourgeois et des illusions.'],
            ['title' => 'Les Misérables', 'description' => 'Une fresque sociale sur la rédemption et l’amour.'],
            ['title' => 'Fahrenheit 451', 'description' => 'Un monde où les livres sont brûlés.'],
            ['title' => 'Le Joueur d’échecs', 'description' => 'Un duel psychologique fascinant.'],
            ['title' => 'Crime et Châtiment', 'description' => 'Un plongeon dans la conscience humaine.'],
            ['title' => 'La Chartreuse de Parme', 'description' => 'Un récit sur l’amour et l’ambition.'],
            ['title' => 'Les Liaisons Dangereuses', 'description' => 'Une intrigue sur le libertinage et la manipulation.'],
        ];
        $cover = ['oui', 'non'];
        $movies = [
            ['name' => 'Inception', 'annee' => 2010, 'duration' => '2h28'],
            ['name' => 'The Matrix', 'annee' => 1999, 'duration' => '2h16'],
            ['name' => 'Interstellar', 'annee' => 2014, 'duration' => '2h49'],
            ['name' => 'Parasite', 'annee' => 2019, 'duration' => '2h12'],
            ['name' => 'The Godfather', 'annee' => 1972, 'duration' => '2h55'],
            ['name' => 'Pulp Fiction', 'annee' => 1994, 'duration' => '2h34'],
            ['name' => 'The Shawshank Redemption', 'annee' => 1994, 'duration' => '2h22'],
            ['name' => 'Fight Club', 'annee' => 1999, 'duration' => '2h19'],
            ['name' => 'Forrest Gump', 'annee' => 1994, 'duration' => '2h22'],
            ['name' => 'Gladiator', 'annee' => 2000, 'duration' => '2h35'],
        ];

        $listAuthor = [];
        for ($i = 0; $i < 20; $i++) {
            // Création de l'auteur lui-même.
            $author = new Author();
            $author->setFirstName($listeFirstname[array_rand($listeFirstname)]);
            $author->setLastName($listeLastname[array_rand($listeLastname)]);
            $manager->persist($author);
            $listAuthor[] = $author;
        }

        // Création des livres
        foreach ($books as $data) {
            $book = new Book();
            $book->setTitle($data['title']);
            $book->setDescription($data['description']);
            $book->setCoverText($cover[array_rand($cover)]);
            $book->setAuthor($listAuthor[array_rand($listAuthor)]);
            $book->setStock(random_int(0,5));
            $manager->persist($book);
        }

        // Création des films
        foreach ($movies as $data) {
            $movie = new Movie();
            $movie->setName($data['name']);
            $movie->setAnnee($data['annee']);
            $movie->setDuration($data['duration']);
            $manager->persist($movie);
        }

        $manager->flush();
    }
}