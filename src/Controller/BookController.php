<?php
// src\Controller\BookController.php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager) // Inject EntityManager
    {
        $this->entityManager = $entityManager;
    }
    public function index(Request $request, BookRepository $repository): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 5;
        $this->denyAccessUnlessGranted('ROLE_USER');
        $result = $repository->pagination($page, $limit);
        $maxPage = ceil($result->count() / $limit);
        return $this->render('/book/index.html.twig',
            [
                'result' => $result,
                'maxPage' => $maxPage,
                'page' => $page,
            ]);
    }
}