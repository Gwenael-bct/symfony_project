<?php
// src\Controller\BookController.php

namespace App\Controller;

use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/book/{id}', name: 'ShowBook')]
    public function showbook(int $id, Request $request, BookRepository $repository): Response
    {
        $book = $repository->findOneBy(['id' => $id]);
        return $this->render('/book/info.html.twig',
            [
                'book' => $book,
            ]);

    }

    public function TakeBook(int $id, Request $request, BookRepository $repository): Response
    {
        $book = $repository->findOneBy(['id' => $id]);
        if (!$book) {
            return new Response('Book not found', Response::HTTP_NOT_FOUND);
        }

        if ($book->getStock() > 0) {
            $book->setStock($book->getStock() - 1);
            $this->entityManager->persist($book);
            $this->entityManager->flush();

            $this->addFlash('success', 'The book is yours!');
        }
        return $this->redirectToRoute('ShowBook', ['id' => $id]); // Redirection en cas d'erreur

        // }
    }

    public function DepositBook(int $id, Request $request, BookRepository $repository): Response
    {
        $book = $repository->findOneBy(['id' => $id]);
        if (!$book) {
            // Handle the case where the book is not found
            return new Response('Book not found', Response::HTTP_NOT_FOUND);
        }
        if ($book->getStock() <= 10) {
            $book->setStock($book->getStock() + 1);
            $this->entityManager->persist($book);
            $this->entityManager->flush();

            $this->addFlash('success', 'the book is deposited');
        } else {
            $this->addFlash('danger', 'The stock are filled');
        }
        return $this->redirectToRoute('ShowBook', ['id' => $id]); // Redirection en cas d'erreur

    }
}