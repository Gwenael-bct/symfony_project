<?php
// src\Controller\BookController.php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) // Inject EntityManager
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request, AuthorRepository $repository): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 5;
        //$this->denyAccessUnlessGranted('ROLE_USER');
        $result = $repository->pagination($page, $limit);
        $maxPage = ceil($result->count() / $limit);
        return $this->render('/author/index.html.twig',
            [
                'result' => $result,
                'maxPage' => $maxPage,
                'page' => $page,
            ]);
    }

}