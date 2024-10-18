<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class test extends AbstractController
{
    public function number(Request $request): Response
    {
        $number = random_int(0, 100);
        $page = $request->headers->get('host');
        $contentsDir = $this->getParameter('kernel.project_dir').'/contents';
        $jison =  $this->json(['username' => 'jane.doe']);
        return $this->render('lucky/number.html.twig', [
            'number' => $number,
            'page' => $page,
            'data' => $contentsDir, // Passer la variable à la vue
            'oui' => $jison
        ]);
    }

}