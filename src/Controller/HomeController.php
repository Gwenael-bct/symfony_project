<?php
namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
class HomeController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('homepage.html.twig');
    }

}
