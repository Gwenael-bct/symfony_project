<?php
namespace App\Controller;


use App\Form\MovieType;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;

// Add this import


class MovieController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) // Inject EntityManager
    {
        $this->entityManager = $entityManager;
    }
    public function index(Request $request, MovieRepository $repository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $result = $repository->findAll();
        return $this->render('movie.html.twig',
        [
            'result' => $result,
        ]);
    }

    public function new(Request $request): Response
    {
        try {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        } catch (\Exception $e) {
            $this->addFlash('danger', 'Pas les autorisations requises ' . $e->getMessage());
            return $this->redirectToRoute('Movie');
        }
        $start_form = true;

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
                $start_form = False;
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
            'start_form' => $start_form
        ]);
    }

    #[Route('/movie/delete/{id}', name: 'movie_delete', methods: ['DELETE'])]
    public function deleteMovie(Movie $movie): Response
    {
        try {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
            $this->entityManager->remove($movie);
            $this->entityManager->flush();
            $this->addFlash('success', 'Movie deleted successfully!');
            return $this->redirectToRoute('Movie'); // Redirige vers la liste des films après suppressio
        } catch (\Exception $e) {
            $this->addFlash('danger', 'Movie not added: ' . $e->getMessage());
            return $this->redirectToRoute('Homepage');
        }
    }

}
