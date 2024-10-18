<?php
namespace App\Controller;

use Symfony\Component\Clock\Clock;
use Symfony\Component\Clock\MockClock;
use App\Form\MovieType;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface; // Add this import


class MovieController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) // Inject EntityManager
    {
        $this->entityManager = $entityManager;
    }
    public function index(Request $request, MovieRepository $repository): Response
    {
        $result = $repository->findAll();
        return $this->render('movie.html.twig',
        [
            'result' => $result,
        ]);
    }

    public function new(Request $request): Response
    {
        Clock::set(new MockClock());
        $clock = Clock::get();
        $clock->withTimeZone('Europe/Paris');
        // creates a task object and initializes some data for this example
        $movie = new Movie();
        $movie->setName('');
        $movie->setAnnee(1);
        $movie->setDuration('Choose duration');

        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $movie = $form->getData();
                $this->entityManager->persist($movie);
                $this->entityManager->flush();
                $this->addFlash('success', 'Movie added successfully!');
            } catch (\Exception $e) {
                $error = $e->getCode();
                if ($error == 1048) {
                    $this->addFlash('danger', 'Movie not added: erreur de saisi');
                } else {
                    $this->addFlash('danger', 'Movie not added: ' . $e->getMessage());
                }
            }
        }
        return $this->render('movie_form.html.twig', [
            'form' => $form,
        ]);
    }

}
