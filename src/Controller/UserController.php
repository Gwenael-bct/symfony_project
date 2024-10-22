<?php

namespace App\Controller;

use App\Service\Variables;
use App\Entity\UserMe;
use App\Form\UserInscription;
use App\Form\UserTypeConnexion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private Variables $prenom_service;

    public function __construct(EntityManagerInterface $entityManager, Variables $prenom_service) // Inject EntityManager
    {
        $this->entityManager = $entityManager;
        $this->prenom_service = $prenom_service;
    }

    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/user/inscription', name: 'app_user_inscription')]
    public function inscription(Request $request): Response
    {
        $user = new UserMe();
        // Configuration de l'utilisateur...

        $form = $this->createForm(UserInscription::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Logique d'inscription...
        }

        return $this->render('user/inscription.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/user/connexion', name: 'app_user_connexion')]
    public function connexion(Request $request): Response
    {
        $user = new UserMe();
        // Configuration de l'utilisateur...

        $form = $this->createForm(UserTypeConnexion::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $existingUser = $this->entityManager->getRepository(UserMe::class)->findOneBy([
                'password' => $user->getPassword(),
                'email' => $user->getEmail()
            ]);

            if ($existingUser) {
                $this->addFlash('success', 'Connexion réussie!');

                $prenom = $this->entityManager->getRepository(UserMe::class)
                    ->createQueryBuilder('u')
                    ->select('u.prenom')
                    ->where('u.email = :email_val')
                    ->setParameter('email_val', $user->getEmail())
                    ->getQuery()
                    ->getSingleScalarResult();

                $this->prenom_service->setPrenom($prenom);
            } else {
                $this->addFlash('danger', 'Échec de la connexion! Mot de passe ou email incorrect.');
            }
        }

        return $this->render('user/connexion.html.twig', [
            'form_connect' => $form,
        ]);
    }
}
